<?php

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Team;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Floor;
use App\Models\Receipt;
use Twilio\Rest\Client;
use App\Jobs\SendSmsJob;
use App\Models\SalesPlan;
use App\Models\UserBatch;
use App\Models\FileAction;
use App\Models\LeadSource;
use App\Models\AccountHead;
use App\Models\ImportImage;
use App\Models\Procurement;
use App\Models\SmsTracking;
use App\Models\Stakeholder;
use Illuminate\Support\Str;
use App\Models\AccountAction;
use App\Models\AccountLedger;
use App\Models\FileSignature;
use App\Models\AdditionalCost;
use App\Models\MaterialReturn;
use App\Models\ItemProcurement;
use App\Models\SiteConfigration;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Models\CommunicationChannel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\{Collection};
use App\Models\SalesPlanInstallments;
use Illuminate\Support\Facades\Crypt;
use App\Models\AccountingStartingCode;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProcurementConfiguration;
use App\Mail\AllCommunicationChannelMail;
use App\Models\CommunicationChannelAction;
use App\Models\EmailCommunicationTemplate;
use App\Models\SmsCommunicationsTemplates;
use App\Lifetimesms\Facades\LifetimesmsFacade;
use App\Models\CommunicationChannelNotification;
use Illuminate\Contracts\Encryption\DecryptException;

if (!function_exists('filter_strip_tags')) {

    function filter_strip_tags($field): string
    {
        return trim(strip_tags($field));
    }
}

if (!function_exists('encode_html_entities')) {

    function encode_html_entities($field): string
    {
        return trim(htmlentities($field));
    }
}

if (!function_exists('decode_html_entities')) {

    function decode_html_entities($field): string
    {
        return trim(html_entity_decode($field));
    }
}

if (!function_exists('numberToWords')) {

    function numberToWords($number): string
    {
        return (new NumberFormatter('en', NumberFormatter::SPELLOUT))->format($number);
    }
}

if (!function_exists('englishCounting')) {

    function englishCounting($number): string
    {
        $detail = '';
        switch ($number) {
            case 1:
                $detail = '1st';
                break;

            case 2:
                $detail = '2nd';
                break;

            case 3:
                $detail = '3rd';
                break;

            default:
                $detail = $number . 'th';
                break;
        }

        return $detail;
    }
}

if (!function_exists('encryptParams')) {
    function encryptParams($params): array|string
    {
        if (is_array($params)) {
            $data = [];
            foreach ($params as $item) {
                $data[] = Crypt::encryptString($item);
            }

            return $data;
        }

        return Crypt::encryptString($params);
    }
}

if (!function_exists('decryptParams')) {
    function decryptParams($params)
    {
        try {

            if (is_array($params)) {
                $data = [];
                foreach ($params as $item) {
                    $data[] = Crypt::decryptString($item);
                }
                return $data;
            }

            $data = Crypt::decryptString($params);
            if (!is_numeric($data)) {
                return decryptParams($data);
            } else {
                return (string) $data;
            }
        } catch (DecryptException $e) {
            return $params;
        }
    }
}

if (!function_exists('getSiteConfiguration')) {
    function getSiteConfiguration($site_id)
    {

        $site_id = decryptParams($site_id);

        $siteConfiguration = (new SiteConfigration())->whereSiteId($site_id)->first();

        return $siteConfiguration ?? null;
    }
}

if (!function_exists('getAllModels')) {
    function getAllModels($path = null): array
    {
        $Modelpath = ($path ?? app_path()) . '/Models';

        $out = [];
        $results = scandir($Modelpath);
        foreach ($results as $result) {
            //			dd($results);
            if ($result === '.' or $result === '..') {
                continue;
            }
            $filename = $Modelpath . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getAllModels($filename));
            } else {
                $out[] = substr($result, 0, -4);
            }
        }

        return $out;
    }
}

if (!function_exists('getTrashedDataCount')) {
    function getTrashedDataCount(): float|int
    {
        $trashed = [];
        foreach (getAllModels() as $model) {
            $models = app("App\Models\\" . $model);
            if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($models))) {
                $trashed[] = $models->onlyTrashed()->count();
            } else {
                $trashed[] = 0;
            }
        }

        return array_sum($trashed);
    }
}

if (!function_exists('getTreeData')) {
    function getTreeData(collection $collectionData, $model, $getFromDB = false): array
    {
        $typesTmp = [];

        // $model = "\\App\\Models\\" . $model;
        $dbTypes = ($getFromDB ? $model::all() : $collectionData);

        foreach ($collectionData as $key => $row) {
            $typesTmp[] = $row;
            $typesTmp[$key]['tree'] = ($getFromDB ? getTypeParentTreeElequent($model, $row, $row->name, $collectionData, $dbTypes) : getTypeParentTreeCollection($row, $row->name, $collectionData));
        }

        return $typesTmp;
        // dd($typesTmp);
    }
}
if (!function_exists('getStakeholderTreeData')) {
    function getStakeholderTreeData(collection $collectionData, $model, $getFromDB = false): array
    {
        $stakeholderTmp = [];

        $dbTypes = ($getFromDB ? $model::all() : $collectionData);

        foreach ($collectionData as $key => $row) {
            $stakeholderTmp[] = $row;
            $stakeholderTmp[$key]['tree'] = ($getFromDB ? getStakholderParentTreeElequent($model, $row, $row->full_name, $collectionData, $dbTypes) : getStakeholderParentTreeCollection($row, $row->full_name, $collectionData));
        }

        return $stakeholderTmp;
    }
}

if (!function_exists('getStakholderParentTreeElequent')) {
    function getStakholderParentTreeElequent($model, $row, $name, collection $parent, $dbTypes)
    {
        if ($row->parent_id == 0) {
            return $name;
        }

        $nextRow = $model::find($row->parent_id);
        $name = $nextRow->full_name . ' > ' . $name;

        return getStakholderParentTreeElequent($model, $nextRow, $name, $parent, $dbTypes);
    }
}

if (!function_exists('getStakeholderParentTreeCollection')) {
    function getStakeholderParentTreeCollection($row, $name, collection $parent): string
    {
        if ($row->parent_id == 0) {
            return $name;
        }

        $nextRow = $parent->firstWhere('id', $row->parent_id);
        $name = (is_null($nextRow) ?? empty($nextRow) ? '' : $nextRow->full_name) . ' > ' . $name;
        if (is_null($nextRow) ?? empty($nextRow)) {
            return $name;
        }

        return getStakeholderParentTreeCollection($nextRow, $name, $parent, $parent);
    }
}

if (!function_exists('getTypeParentTreeElequent')) {
    function getTypeParentTreeElequent($model, $row, $name, collection $parent, $dbTypes)
    {
        if ($row->parent_id == 0) {
            return $name;
        }

        $nextRow = $model::find($row->parent_id);
        $name = $nextRow->name . ' > ' . $name;

        return getTypeParentTreeElequent($model, $nextRow, $name, $parent, $dbTypes);
    }
}

if (!function_exists('getTypeParentTreeCollection')) {
    function getTypeParentTreeCollection($row, $name, collection $parent): string
    {
        if ($row->parent_id == 0) {
            return $name;
        }

        $nextRow = $parent->firstWhere('id', $row->parent_id);
        $name = (is_null($nextRow) ?? empty($nextRow) ? '' : $nextRow->name) . ' > ' . $name;
        if (is_null($nextRow) ?? empty($nextRow)) {
            return $name;
        }

        return getTypeParentTreeCollection($nextRow, $name, $parent, $parent);
    }
}

if (!function_exists('getLinkedTreeData')) {
    function getLinkedTreeData(Model $model, $id = [])
    {
        $id = $model::whereIn('parent_id', $id)->get()->toArray();
        if (count($id) > 0) {
            return array_merge($id, getLinkedTreeData($model, array_column($id, 'id')));
        }

        return $id;
    }
}

if (!function_exists('base64ToImage')) {
    function base64ToImage($image): string
    {
        ini_set('memory_limit', '256M');
        $filename = 'TelK7BnW63IAN6zuTTwJkqZeuM0YI5aNc7aFqOyz.jpg';
        if (!empty($image)) {
            $dir = $_SERVER['DOCUMENT_ROOT'] . config('app.asset_url') . DIRECTORY_SEPARATOR . 'public_assets/admin/sites_images';
            $image_parts = explode(';base64,', $image);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = uniqid() . '.' . $image_type;
            $file = $dir . DIRECTORY_SEPARATOR . $filename;
            file_put_contents($file, $image_base64);
        }

        return $filename;
    }
}
if (!function_exists('account_numberFormat')) {
    function account_numberFormat($account_number): string
    {
        $first_6_number = substr($account_number, 0, 6);
        $code = wordwrap($first_6_number, 2, '-', true);
        if (Str::length($account_number) > 6) {
            $code = $code . '-' . $next_4_number = substr($account_number, 6, 4);
        }
        if (Str::length($account_number) > 10) {
            $code = $code . '-' . $after_10_number = substr($account_number, 10);
        }

        return $code;
    }
}

// if (!function_exists('makeImageThumbs')) {
//     function makeImageThumbs($request, $key = ""): string
//     {
//         $publicPath = public_path('public_assets/admin/sites_images') . DIRECTORY_SEPARATOR;
//         if (!is_string($request)) {
//             if (is_array($request)) {
//                 $image = $request[$key];
//             } else {
//                 $image = $request->file($key);
//             }
//             $imageHashedName = $image->hashName();
//         } else {
//             $image = $publicPath . $request;
//         }

//         $imgExplodedName = explode(".", $imageHashedName);

//         $img = Image::make($image)->backup();

//         $img->resize(1000, null, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         })->save($publicPath . $imgExplodedName[0] . '-thumbs1000.' . $imgExplodedName[1]);
//         $img->reset();

//         $img->resize(600, null, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         })->save($publicPath . $imgExplodedName[0] . '.' . $imgExplodedName[1]);
//         $img->reset();

//         $img->resize(350, null, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         })->save($publicPath . $imgExplodedName[0] . '-thumbs350.' . $imgExplodedName[1]);
//         $img->reset();

//         $img->resize(200, null, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         })->save($publicPath . $imgExplodedName[0] . '-thumbs200.' . $imgExplodedName[1]);
//         $img->reset();

//         $img->destroy();

//         return $imgExplodedName[0] . '.' . $imgExplodedName[1];
//     }
// }

if (!function_exists('deleteImageThumbs')) {
    function deleteImageThumbs($imgName, $imageDirectory = 'admin'): string
    {
        $publicServerPath = public_path('public_assets/' . $imageDirectory . '/sites_images') . DIRECTORY_SEPARATOR;
        if (File::exists($publicServerPath . $imgName)) {
            $imageExplodedName = explode('.', $imgName);
            // dd($imageExplodedName);
            File::delete([
                $publicServerPath . $imageExplodedName[0] . '.' . $imageExplodedName[1],
                $publicServerPath . $imageExplodedName[0] . '-thumbs1000.' . $imageExplodedName[1],
                $publicServerPath . $imageExplodedName[0] . '-thumbs350.' . $imageExplodedName[1],
                $publicServerPath . $imageExplodedName[0] . '-thumbs200.' . $imageExplodedName[1],
            ]);

            return true;
        }

        return false;
    }
}

if (!function_exists('getImageByName')) {
    function getImageByName($imgName, $imageDirectory = 'admin'): array
    {
        $img = '';
        $imgThumb = '';
        $publicServerPath = public_path('public_assets/' . $imageDirectory . '/sites_images') . DIRECTORY_SEPARATOR;
        $publicLinkPath = asset('public_assets/' . $imageDirectory . '/sites_images') . DIRECTORY_SEPARATOR;

        $imageExplodedName = explode('.', (!is_null($imgName) && !empty($imgName) ? $imgName : 'TelK7BnW63IAN6zuTTwJkqZeuM0YI5aNc7aFqOyz.jpg'));

        if (File::exists($publicServerPath . ($imageExplodedName[0] . '-thumbs200.' . $imageExplodedName[1]))) {
            $img = $publicLinkPath . $imageExplodedName[0] . '-thumbs1000.' . $imageExplodedName[1];
            $imgThumb = $publicLinkPath . $imageExplodedName[0] . '-thumbs200.' . $imageExplodedName[1];
        } elseif (File::exists($publicServerPath . ($imageExplodedName[0] . '.' . $imageExplodedName[1]))) {
            $img = $publicLinkPath . $imageExplodedName[0] . '.' . $imageExplodedName[1];
            $imgThumb = $publicLinkPath . $imageExplodedName[0] . '.' . $imageExplodedName[1];
        } else {
            $img = $publicLinkPath . 'do_not_delete/do_not_delete.png';
            $imgThumb = $publicLinkPath . 'do_not_delete/do_not_delete.png';
        }

        return [$img, $imgThumb];
    }
}

if (!function_exists('editDateColumn')) {
    function editDateColumn($date)
    {
        $date = new Carbon($date);

        return '<span>' . $date->format('d-M-Y') . "</span> <span class=''>" . $date->format('H:i:s') . '</span>';
    }
}

if (!function_exists('editOnlyDateColumn')) {
    function editOnlyDateColumn($date)
    {
        $date = new Carbon($date);

        return "<span class='text-primary fw-bold'>" . $date->format('Y-m-d') . '</span>';
    }
}

if (!function_exists('getTypeNameByID')) {
    function getTypeNameByID($type_id)
    {
        $type = (new Type())->where('id', $type_id)->first();
        if ($type) {
            return $type->name;
        }

        return 'parent';
    }
}

if (!function_exists('editBooleanColumn')) {
    function editBooleanColumn($boolean)
    {
        if ($boolean) {
            return "<span class='badge rounded-pill bg-success me-1'>" . __('lang.commons.yes') . '</span>';
        } else {
            return "<span class='badge rounded-pill bg-danger me-1'>" . __('lang.commons.no') . '</span>';
        }
    }
}

if (!function_exists('editBadgeColumn')) {
    function editBadgeColumn($value)
    {

        return "<span class='badge rounded-pill bg-label-primary me-1'>" . $value . '</span>';
    }
}

if (!function_exists('getTypeParentByParentId')) {
    function getTypeParentByParentId($parent_id)
    {
        $type = (new Type())->where('id', $parent_id)->first();
        if ($type) {
            return $type->name;
        }

        return 'parent';
    }
}

if (!function_exists('getRoleParentByParentId')) {
    function getRoleParentByParentId($parent_id)
    {
        $role = (new Role())->where('id', $parent_id)->first();
        if ($role) {
            return $role->name;
        }

        return 'parent';
    }
}

//

if (!function_exists('getUnitUnifurcateParentByUnifurcateParentId')) {
    function getUnitUnifurcateParentByUnifurcateParentId($parent_id)
    {
        $unit = (new Unit())->select('id', 'name')->where('id', $parent_id)->first();
        if ($unit) {
            return editBadgeColumn($unit->name);
        }

        return '-';
    }
}

if (!function_exists('getParentRolePermissionsByParentId')) {
    function getParentRolePermissionsByParentId($parent_id)
    {
        $role = (new Role())->where('id', $parent_id)->first();
        if ($role) {
            return $role->permissions;
        }

        return [];
    }
}

if (!function_exists('getAllPermissions')) {
    function getAllPermissions($role_id)
    {
        $permissions = [];
        $role = (new Role())->where('id', $role_id)->first();
        // dd($role->permissions);
        if ($role) {
            if ($role->is_child == true) {

                $ParentRole = (new Role())->where('id', $role->parent_id)->first();
                foreach ($ParentRole->permissions as $permission) {
                    $permissions[$permission->name] = $permission;
                }
            }
            foreach ($role->permissions as $permission) {
                $permissions[$permission->name] = $permission;
            }
        }

        // dd($permissions);
        return $permissions;
    }
}

if (!function_exists('hasAllPermissions')) {
    function hasAllPermissions($role)
    {
        $rolepermissions = $role->permissions->count();
        $ParentRole = (new Role())->where('id', $role->parent_id)->first();
        $parentpermissions = $ParentRole->permissions->count();
        if ($rolepermissions == $parentpermissions) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('getStakeholderParentByParentId')) {
    function getStakeholderParentByParentId($parent_id)
    {
        $Stakeholder = (new Stakeholder())->where('id', $parent_id)->first();
        if ($Stakeholder) {
            return $Stakeholder->full_name;
        }

        return 'Nill';
    }
}

if (!function_exists('getAdditionalCostByParentId')) {
    function getAdditionalCostByParentId($parent_id)
    {
        $additionalCost = (new AdditionalCost())->where('id', $parent_id)->first();
        if ($additionalCost) {
            return $additionalCost->name;
        }

        return 'parent';
    }
}

if (!function_exists('getAuthentacatedUserInfo')) {
    function getAuthentacatedUserInfo()
    {
        $roles = auth()->user()->roles->toArray();
        $parentRoles = [];
        foreach ($roles as $role) {
            if ($role['is_child'] == false) {
                $parentRoles[] = $role['name'];
            } else {
                $parentRoles[] = getRoleParentByParentId($role['parent_id']);
            }
        }
        $user = new stdClass();
        $user->data = auth()->user();
        $user->roles = implode(', ', $parentRoles);

        return $user;
    }
}

if (!function_exists('getNHeightestNumber')) {
    function getNHeightestNumber($numberOfDigits = 1)
    {
        return (int) str_repeat('9', $numberOfDigits);
    }
}

if (!function_exists('getbatchesByUserID')) {
    function getbatchesByUserID($user_id, $action_id = 0)
    {

        $user_id = decryptParams($user_id);

        $batches = (new UserBatch())->whereUserId($user_id)->limit(20)->latest();
        if ($action_id > 0) {
            $batches = $batches->whereActionId($action_id)->limit(20)->latest();
        }

        return $batches->get() ?? null;
    }
}

if (!function_exists('apiErrorResponse')) {
    function apiErrorResponse($message = 'data not found', $key = 'error')
    {
        return response()->json(
            [
                'status' => false,
                'message' => [
                    $key => $message,
                ],
                'data' => null,
                'stauts_code' => '200',
            ],
            200
        );
    }
}

if (!function_exists('apiSuccessResponse')) {
    function apiSuccessResponse($data = null, $message = 'data found', $key = 'success')
    {
        return response()->json(
            [
                'status' => true,
                'message' => [
                    $key => $message,
                ],
                'data' => $data,
                'stauts_code' => '200',
            ],
            200
        );
    }
}

if (!function_exists('sqlErrorMessagesByCode')) {
    function sqlErrorMessagesByCode($errCode)
    {
        $messages = [
            '1062' => 'Duplicate entry',
            '1452' => 'Cannot add or update a child row',
            '1451' => 'Cannot delete or update a parent row',
            '1364' => 'Field does not have a default value',
            '1048' => 'Column cannot be null',
            '1054' => 'Unknown column',
            '1052' => 'Column in where clause is ambiguous',
            '1051' => 'Unknown table',
            '1050' => 'Table already exists',
            '1046' => 'No database selected',
            '1045' => 'Access denied for user',
            '1044' => 'Access denied for user',
            '1042' => 'Can\'t get hostname for your address',
            '1040' => 'Too many connections',
            '1038' => 'Out of sort memory, consider increasing server sort buffer size',
            '1036' => 'Table is read only',
            '1035' => 'CRASHED ON USAGE',
            '1034' => 'CRASHED ON REPAIR',
            '1033' => 'Out of memory; restart server and try again (needed 98304 bytes)',
            '23505' => 'Data already exists',
        ];

        return $messages[$errCode] ?? 'Unknown error';
    }
}

if (!function_exists('cnicFormat')) {
    function cnicFormat($cnic)
    {
        $data = Str::of($cnic)->substrReplace('-', 5, 0)->substrReplace('-', 13, 0);

        return $data;
    }
}

if (!function_exists('storeMultiValue')) {
    function storeMultiValue($model, $data)
    {
        // dd($data);
        foreach ($data as $key => $value) {
            $model->multiValues()->create([
                'type' => $key,
                'value' => is_array($value) ? '' : $value,
            ]);
        }
    }
}

if (!function_exists('getTeamParentByParentId')) {
    function getTeamParentByParentId($parent_id)
    {
        $team = (new Team())->where('id', $parent_id)->first();
        if ($team) {
            return $team->name;
        }

        return 'parent';
    }
}

if (!function_exists('getUserBrowserInfo')) {
    function getUserBrowserInfo($request)
    {
        $userPcInfo = new stdClass();
        $userPcInfo->ip = $request->ip();
        $userPcInfo->os = $request->header('User-Agent');

        return $userPcInfo;
    }
}

if (!function_exists('actionLog')) {
    function actionLog($logName, $causedByModel, $performedOnModel, $log, $properties = [], $event = '')
    {
        return activity()
            ->causedBy($causedByModel)
            ->performedOn($performedOnModel)
            ->inLog($logName)
            ->event($event)
            ->withProperties($properties)
            ->log($log);
    }
}

if (!function_exists('getMaxFloorOrder')) {
    function getMaxFloorOrder($site_id)
    {
        return (new Floor())->where('site_id', $site_id)->max('order');
    }
}

if (!function_exists('getMaxUnitNumber')) {
    function getMaxUnitNumber($floor_id)
    {
        return (new Unit())->where('floor_id', $floor_id)->max('unit_number');
    }
}

if (!function_exists('getModelsClasses')) {
    function getModelsClasses(string $dir, array $excepts = null, array $includes = null)
    {
        if ($excepts === null) {
            $excepts = [
                'App\Models\AccountAction',
                'App\Models\AccountActionBinding',
                'App\Models\AccountHead',
                'App\Models\AccountingStartingCode',
                'App\Models\AccountLedger',
                'App\Models\AccountPayable',
                'App\Models\CustomerAccountPayable',
                'App\Models\DealerAccountPayable',
                'App\Models\SupplierAccountPayable',
                'App\Models\Bank',
                'App\Models\Cash',
                'App\Models\Upload',
                'App\Models\CustomField',
                'App\Models\Media',
                'App\Models\CustomFieldValue',
                'App\Models\City',
                'App\Models\Country',
                'App\Models\AppSetting',
                'App\Models\FileAction',
                'App\Models\FileAdjustment',
                'App\Models\FileRefundAttachment',
                'App\Models\FileAdjustmentAttachment',
                'App\Models\FileTitleTransferAttachment',
                'App\Models\FileCancellationAttachment',
                'App\Models\FileBuyBackLabelsAttachment',
                'App\Models\FileResaleAttachment',
                'App\Models\ModelTemplate',
                'App\Models\UserBatch',
                'App\Models\UnitStakeholder',
                'App\Models\Template',
                'App\Models\TeamUser',
                'App\Models\Status',
                'App\Models\State',
                'App\Models\SalesPlanTemplate',
                'App\Models\Permission',
                'App\Models\Role',
                'App\Models\Status',
                'App\Models\StakeholderContact',
                'App\Models\StakeholderType',
                'App\Models\SalesPlan',
                'App\Models\SalesPlanAdditionalCost',
                'App\Models\SalesPlanInstallments',
                'App\Models\ReceiptDraftModel',
                'App\Models\ReceiptTemplate',
                'App\Models\Notification',
                'App\Models\MultiValue',
                'App\Models\SiteOwner',
                'App\Models\TempStakeholder',
                'App\Models\StakeholderNextOfKin',
                'App\Models\TempUnit',
                'App\Models\TempUnitType',
                'App\Models\TempSalesPlanAdditionalCost',
                'App\Models\TempSalePlanInstallment',
                'App\Models\TempReceipt',
            ];
        }
        if ($includes === null) {
            $includes = [
                'App\Models\Stakeholder',
                'App\Models\Type',
                'App\Models\Floor',
                'App\Models\AdditionalCost',
                'App\Models\LeadSource',
                'App\Models\User',
                'App\Models\Team',
            ];
        }
        $customFieldModels = [];
        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, ['.', '..'])) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $customFieldModels[$value] = getModelsClasses($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $fullClassName = 'App\\Models\\' . basename($value, '.php');
                    if (in_array($fullClassName, $includes)) {
                        $customFieldModels[$fullClassName] = Str::snake(basename($value, '.php'));
                    }
                }
            }
        }

        return $customFieldModels;
    }
}

if (!function_exists('generateCheckbox')) {
    function generateCheckbox($isEditMode, $customFieldValue, $id, $name, $label, $bootstrapCols, $values = '', $required = false, $checked = false, $disabled = false, $with_col = true)
    {
        $element = view('app.partial-components.checkbox', [
            'isEditMode' => $isEditMode,
            'customFieldValue' => $customFieldValue,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'bootstrapCols' => $bootstrapCols,
            'with_col' => $with_col,
            'value' => $values ? key($values) : '',
            'required' => $required,
            'checked' => $checked,
            'disabled' => $disabled,
        ])->render();

        return $element;
    }
}

if (!function_exists('generateDate')) {
    function generateDate($isEditMode, $customFieldValue, $id, $name, $label, $bootstrapCols, $value = '', $required = false, $disabled = false, $readonly = false, $with_col = true)
    {
        $element = view('app.partial-components.date', [
            'isEditMode' => $isEditMode,
            'customFieldValue' => $customFieldValue,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'bootstrapCols' => $bootstrapCols,
            'with_col' => $with_col,
            'value' => $value,
            'required' => $required,
            'disabled' => $disabled,
            'readonly' => $readonly,
        ])->render();

        return $element;
    }
}

if (!function_exists('generateInput')) {
    function generateInput($isEditMode, $customFieldValue, $maxlength, $minlength, $min, $max, $type, $id, $name, $label, $bootstrapCols, $value = '', $required = false, $disabled = false, $readonly = false, $with_col = true)
    {
        $element = view('app.partial-components.input', [
            'isEditMode' => $isEditMode,
            'customFieldValue' => $customFieldValue,
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'bootstrapCols' => $bootstrapCols,
            'with_col' => $with_col,
            'value' => $value,
            'required' => $required,
            'disabled' => $disabled,
            'readonly' => $readonly,
            'maxlength' => $maxlength,
            'minlength' => $minlength,
            'min' => $min,
            'max' => $max,
        ])->render();

        return $element;
    }
}

if (!function_exists('generateTextarea')) {
    function generateTextarea($isEditMode, $customFieldValue, $maxlength, $minlength, $id, $name, $label, $bootstrapCols, $value = '', $required = false, $disabled = false, $readonly = false, $with_col = true)
    {
        $element = view('app.partial-components.textarea', [
            'isEditMode' => $isEditMode,
            'customFieldValue' => $customFieldValue,
            'maxlength' => $maxlength,
            'minlength' => $minlength,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'bootstrapCols' => $bootstrapCols,
            'with_col' => $with_col,
            'value' => $value,
            'required' => $required,
            'disabled' => $disabled,
            'readonly' => $readonly,
        ])->render();

        return $element;
    }
}

if (!function_exists('generateSelect')) {
    function generateSelect($isEditMode, $customFieldValue, $multiple, $id, $name, $label, $bootstrapCols, $values = '', $required = false, $disabled = false, $readonly = false, $with_col = true)
    {

        $element = view('app.partial-components.select', [
            'isEditMode' => $isEditMode,
            'customFieldValue' => $customFieldValue,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'bootstrapCols' => $bootstrapCols,
            'with_col' => $with_col,
            'values' => $values,
            'required' => $required,
            'disabled' => $disabled,
            'readonly' => $readonly,
            'multiple' => $multiple,
        ])->render();

        return $element;
    }
}

if (!function_exists('generateRadio')) {
    function generateRadio($isEditMode, $customFieldValue, $id, $name, $label, $bootstrapCols, $values = '', $required = false, $disabled = false, $readonly = false, $with_col = true)
    {

        $element = view('app.partial-components.radio', [
            'isEditMode' => $isEditMode,
            'customFieldValue' => $customFieldValue,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'bootstrapCols' => $bootstrapCols,
            'with_col' => $with_col,
            'values' => $values,
            'required' => $required,
            'disabled' => $disabled,
            'readonly' => $readonly,
        ])->render();

        return $element;
    }
}

if (!function_exists('generateCustomFields')) {
    function generateCustomFields($customFields, $isEditMode = false, $modelId = 0)
    {
        $customFieldHTML = [];

        foreach ($customFields as $customField) {
            switch ($customField->type) {
                case 'checkbox':
                    $customFieldHTML[] = generateCheckbox(
                        $isEditMode,
                        $customField->CustomFieldValue->where('modelable_id', $modelId)->first(),
                        $customField->slug,
                        $customField->slug,
                        $customField->name,
                        $customField->bootstrap_column,
                        $customField->values,
                        $customField->required,
                        $customField->checked,
                        $customField->disabled,
                    );

                    break;

                case 'date':
                    $customFieldHTML[] = generateDate(
                        $isEditMode,
                        $customField->CustomFieldValue->where('modelable_id', $modelId)->first(),
                        $customField->slug,
                        $customField->slug,
                        $customField->name,
                        $customField->bootstrap_column,
                        $customField->value[0] ?? 'today',
                        $customField->required,
                        $customField->disabled,
                        $customField->readonly,
                    );

                    break;

                case 'email':
                case 'number':
                case 'password':
                case 'text':

                    $customFieldHTML[] = generateInput(
                        $isEditMode,
                        $customField->CustomFieldValue->where('modelable_id', $modelId)->first(),
                        $customField->maxlength,
                        $customField->minlength,
                        $customField->min,
                        $customField->max,
                        $customField->type,
                        $customField->slug,
                        $customField->slug,
                        $customField->name,
                        $customField->bootstrap_column,
                        '',
                        $customField->required,
                        $customField->disabled,
                        $customField->readonly,
                    );

                    break;

                case 'textarea':
                    $customFieldHTML[] = generateTextarea(
                        $isEditMode,
                        $customField->CustomFieldValue->where('modelable_id', $modelId)->first(),
                        $customField->maxlength,
                        $customField->minlength,
                        $customField->slug,
                        $customField->slug,
                        $customField->name,
                        $customField->bootstrap_column,
                        '',
                        $customField->required,
                        $customField->disabled,
                        $customField->readonly,
                    );

                    break;

                case 'select':
                    $customFieldHTML[] = generateSelect(
                        $isEditMode,
                        $customField->CustomFieldValue->where('modelable_id', $modelId)->first(),
                        $customField->multiple,
                        $customField->slug,
                        $customField->slug,
                        $customField->name,
                        $customField->bootstrap_column,
                        $customField->values,
                        $customField->required,
                        $customField->disabled,
                        $customField->readonly,
                    );

                    break;
                case 'radio':
                    $customFieldHTML[] = generateRadio(
                        $isEditMode,
                        $customField->CustomFieldValue->where('modelable_id', $modelId)->first(),
                        $customField->slug,
                        $customField->slug,
                        $customField->name,
                        $customField->bootstrap_column,
                        $customField->values,
                        $customField->required,
                        $customField->disabled,
                        $customField->readonly,
                    );

                    break;

                default:
                    // code...
                    break;
            }
        }

        return $customFieldHTML;
    }
}

if (!function_exists('changeImageDirectoryPermission')) {
    function changeImageDirectoryPermission()
    {
        $path = public_path() . '/app-assets/server-uploads';
        // exec('chmod -R 775 ' . public_path());
        if (is_dir($path)) {
            exec('chmod -R 755 ' . $path);

            return 'true';
        } else {
            return false;
        }
    }
}

if (!function_exists('changeStorsgeDirectoryPermission')) {
    function changeStorsgeDirectoryPermission()
    {
        $path = public_path() . '/storage/export_files/';
        if (is_dir($path)) {
            exec('chmod -R 755 ' . $path);
        }
    }
}

if (!function_exists('generateSlug')) {
    function generateSlug($site_id, $name, $model)
    {
        $slugCount = 0;
        $slug = Str::slug($name);
        $tmpSlug = $slug;
        $isUniqueSlug = false;
        while (!$isUniqueSlug) {
            if ($model->where('site_id', $site_id)->where('slug', $tmpSlug)->exists()) {
                $slugCount++;
                $tmpSlug = $slug . '-' . $slugCount;
            } else {
                $isUniqueSlug = true;
                $slug = $tmpSlug;
            }
        }

        return $slug;
    }
}

if (!function_exists('addAccountCodes')) {
    function addAccountCodes($model)
    {

        $account_starting_code = AccountingStartingCode::where([
            'level' => 2,
            'model' => $model,
        ])->orderBy('starting_code')->first();

        $account_ending_code = AccountingStartingCode::where([
            'level' => 2,
            'level_code' => $account_starting_code->level_code,
        ])->where(
            'starting_code',
            '>',
            $account_starting_code->starting_code
        )->orderBy('starting_code')->first();

        $starting_code = intval($account_starting_code->level_code . $account_starting_code->starting_code);
        $ending_code = intval(empty($account_ending_code) ? 999999 : $account_ending_code->level_code . $account_ending_code->starting_code);

        $account_head = AccountHead::whereHasMorph(
            'modelable',
            $model,
        )->get();

        $account_code = $starting_code;

        if (isset($account_head) && count($account_head) > 0) {
            $last_account_head = collect($account_head)->last();
            // dd($last_account_head);
            $level = $last_account_head->level;
            $level_code = $last_account_head->level_code;

            $account_code = $account_head->max('code') + 1;
            if ($account_code >= $ending_code) {
                throw new GeneralException('Accounts are conflicting. Please rearrange your coding system.');
            }
        }

        return $account_code;
    }
}

if (!function_exists('getTypeAncesstorData')) {
    function getTypeAncesstorData($type_id)
    {
        $type = (new Type())->find($type_id);
        if ($type->parent_id > 0) {
            $type = getTypeAncesstorData($type->parent_id);
        }

        return $type;
    }
}

if (!function_exists('createRandomAlphaNumericCode')) {
    function createRandomAlphaNumericCode()
    {
        $numerics = '0123456789';
        $pass = [];
        $numericLength = strlen($numerics) - 1;
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $numericLength);
            $pass[] = $numerics[$n];
        }
        $code = implode($pass);

        return str_shuffle($code);
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 6)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters) - 1;
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength)];
        }

        return Str::lower($randomString);
    }
}

if (!function_exists('getFileUploadId')) {
    function getFileUploadId()
    {
        $uniqid = uniqid();
        $import = ImportImage::create([
            'uniqid' => $uniqid,
        ]);

        return $import->id;
    }
}

if (!function_exists('uploadFilePatch')) {
    function uploadFilePatch($request)
    {
        $id = $request->get('patch');
        $id = Str::before($id, '<link');
        $dir = public_path('app-assets/images/temporaryfiles/');

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        // get chunk data
        $offset = $request->header('Upload-Offset');
        $length = $request->header('Upload-Length');
        // should be numeric values, else exit
        if (!is_numeric($offset) || !is_numeric($length)) {
            return apiErrorResponse();
        }
        // exec('chmod -R 0775 ' . $dir);
        // write chunk file for this request
        file_put_contents($dir . $id . '.' . '.chunk.' . $offset, fopen('php://input', 'rb'));
        // calculate total size of chunks
        $size = 0;
        $chunk = glob($dir . $id . '.' . '.chunk.*');
        foreach ($chunk as $filename) {
            $size += filesize($filename);
        }
        // if total size equals length of file we have gathered all chunk files
        if ($size == $length) {

            $file = $request->header('upload-name');
            $ext = File::extension($file);
            $name = str_replace($ext, '', Str::replace(' ', '_', File::basename($file)));
            $ext = Str::endsWith($name, '.') ? $ext : '.' . $ext;
            $name = $name . $ext;
            $imageimport = ImportImage::find($id);
            $imageimport->name = $name;
            $imageimport->save();
            // create output file
            $file_handle = fopen($dir . $name, 'wb');

            // write chunkes to file
            foreach ($chunk as $filename) {
                // get offset from filename
                [$dir, $offset] = explode('.chunk.', $filename, 2);
                // read chunk and close
                $chunk_handle = fopen($filename, 'rb');
                $chunk_contents = fread($chunk_handle, filesize($filename));
                fclose($chunk_handle);

                // apply chunk
                fseek($file_handle, $offset);
                fwrite($file_handle, $chunk_contents);
            }
            // remove chunkes
            foreach ($chunk as $filename) {
                unlink($filename);
            }
            // done with file
            fclose($file_handle);
            actionLog(get_class($imageimport), auth()->user(), $imageimport, 'file Uploaded', [
                'attributes' => $imageimport->toArray(), 'created',
            ]);

            return apiSuccessResponse($imageimport);

            return Response::make($imageimport, 204);
        }

        // return $size;
        return apiSuccessResponse($size);

        return Response::make('chunk uploaded' . $size, 204);
    }
}

// revert File Upload
if (!function_exists('revertFileUpload')) {
    function revertFileUpload($request)
    {
        $id = $request->getContent();
        $id = Str::before($id, '<link');

        $imageimport = ImportImage::find($id);
        $dir = public_path('app-assets/images/temporaryfiles/');
        $file = $dir . $imageimport->name;
        $test = File::delete($file);
        $imageimport->delete();

        return $test;
    }
}

// get server uploaded file path
if (!function_exists('getFilePath')) {
    function getFilePath($attachment)
    {
        $id = Str::before($attachment, '<link');
        $imageimport = ImportImage::find($id);
        if (!$imageimport) {
            return false;
        }
        if (File::exists(public_path('app-assets/images/temporaryfiles/') . $imageimport->name)) {
            return public_path('app-assets/images/temporaryfiles/') . $imageimport->name;
        } else {
            return false;
        }
    }
}

// get account balance
if (!function_exists('getAccountBalanceWithEntries')) {
    function getAccountBalanceWithEntries($code)
    {
        $credit = 0;
        $debit = 0;
        $amount = 0;
        $entries_array = [];
        $account_head = (new AccountHead())->where('code', $code)->first();
        if ($account_head) {
            $entries = $account_head->accountLedgers;
            if ($entries) {
                foreach ($entries as $key2 => $entry) {
                    $credit += $entry->credit;
                    $debit += $entry->debit;
                    array_push($entries_array, [
                        'credit' => $entry->credit,
                        'debit' => $entry->debit,
                        'action' => $entry->accountActions->name,
                        'created_date' => $entry->created_date,
                    ]);
                }
            }
            $amount = $account_head->account_type == 'credit' ? ($credit - $debit) : ($debit - $credit);
        }

        return [
            'credit' => $credit,
            'debit' => $debit,
            'amount' => $amount,
            'entries' => $entries_array,
        ];
    }
}

// get account debit Balance
if (!function_exists('getAccountDebitBalance')) {
    function getAccountDebitBalance($account_head, $account_level, $start_date, $end_date)
    {
        $sum = 0;

        switch ($account_level) {

            case '1':

                $starting_code = $account_head->code . '000000000000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '000000000000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();

                break;

            case '2':

                $starting_code = $account_head->code . '0000000000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '0000000000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();

                break;

            case '3':

                $starting_code = $account_head->code . '00000000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '00000000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();

                break;

            case '4':

                $starting_code = $account_head->code . '0000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '0000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();

                break;

            default:

                if ($start_date != '') {
                    if ($account_head->account_type == 'debit') {
                        $debit = $account_head->accountLedgers()->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
                        $credit = $account_head->accountLedgers()->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
                        $sum = (float) $debit - (float) $credit;
                    } else {
                        $sum = 0;
                    }
                } else {
                    if ($account_head->account_type == 'debit') {
                        $debit = $account_head->accountLedgers->sum('debit');
                        $credit = $account_head->accountLedgers->sum('credit');
                        $sum = (float) $debit - (float) $credit;
                    } else {
                        $sum = 0;
                    }
                }

                return $sum;

                break;
        }

        foreach ($accounts as $key => $fourth_level_account) {

            $debit = 0.0;
            $credit = 0.0;


            if ($start_date != '' && $end_date != '') {
                $ledgers = AccountLedger::where('account_head_code', $fourth_level_account->code)
                    ->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->get();
            } elseif ($start_date != '' && $end_date == '') {
                $ledgers = AccountLedger::where('account_head_code', $fourth_level_account->code)
                    ->whereDate('created_date', '>=', $start_date)->get();
            } else {
                $ledgers = AccountLedger::where('account_head_code', $fourth_level_account->code)->get();
            }

            foreach ($ledgers as $key => $ledger) {

                if (isset($ledger->debit)) {
                    $debit = $ledger->debit;
                }

                if (isset($ledger->credit)) {
                    $credit = $ledger->credit;
                }

                $sum = $sum + ((float) $debit - (float) $credit);
            }
        }

        return $sum;

        // $balance = 0;

        // if ($start_date != '' && $end_date != '') {
        //     $debit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
        //     $credit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        // } else {
        //     $debit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->sum('debit');
        //     $credit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->sum('credit');
        // }


        // $balance = 0;

        // $balance = $debit - $credit;

        // return $balance;
    }
}

// get account Credit Balance
if (!function_exists('getAccountCreditBalance')) {
    function getAccountCreditBalance($account_head, $account_level, $start_date, $end_date)
    {
        $sum = 0;
        switch ($account_level) {
            case '1':
                $starting_code = $account_head->code . '000000000000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '000000000000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();
                break;

            case '2':
                $starting_code = $account_head->code . '0000000000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '0000000000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();
                break;

            case '3':
                $starting_code = $account_head->code . '00000000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '00000000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();
                break;

            case '4':
                $starting_code = $account_head->code . '0000';
                $ending_code = (int) $account_head->code + 1;
                $ending_code = (string) $ending_code . '0000';
                $accounts = AccountHead::where('level', 5)->whereBetween('code', [$starting_code, $ending_code])->get();
                break;

            default:
                if ($start_date != '') {
                    if ($account_head->account_type == 'credit') {
                        $debit = $account_head->accountLedgers()->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
                        $credit = $account_head->accountLedgers()->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
                        $sum = (float) $credit - (float) $debit;
                    } else {
                        $sum = 0;
                    }
                } else {
                    if ($account_head->account_type == 'credit') {
                        $debit = $account_head->accountLedgers->sum('debit');
                        $credit = $account_head->accountLedgers->sum('credit');
                        $sum = (float) $credit - (float) $debit;
                    } else {
                        $sum = 0;
                    }
                }

                return $sum;
                break;
        }

        foreach ($accounts as $key => $fourth_level_account) {
            $debit = 0.0;
            $credit = 0.0;
            if ($start_date != '' && $end_date != '') {
                $ledgers = AccountLedger::where('account_head_code', $fourth_level_account->code)
                    ->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->get();
            } elseif ($start_date != '' && $end_date == '') {
                $ledgers = AccountLedger::where('account_head_code', $fourth_level_account->code)
                    ->whereDate('created_date', '>=', $start_date)->get();
            } else {
                $ledgers = AccountLedger::where('account_head_code', $fourth_level_account->code)->get();
            }
            foreach ($ledgers as $key => $ledger) {
                if (isset($ledger->debit)) {
                    $debit = $ledger->debit;
                }
                if (isset($ledger->credit)) {
                    $credit = $ledger->credit;
                }
                $sum = $sum + ((float) $credit - (float) $debit);
            }
        }

        return $sum;
        // $balance = 0;

        // if ($start_date != '' && $end_date != '') {
        //     $debit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
        //     $credit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        // } else {
        //     $debit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->sum('debit');
        //     $credit = AccountLedger::whereRaw('account_head_code Like (?)', $account_head->code . '%')->sum('credit');
        // }


        // $balance = 0;

        // $balance = $credit - $debit;

        // return $balance;
    }
}

// sales plan total price with expense
if (!function_exists('getSalesPlanTotalPriceWithExpense')) {
    function getSalesPlanTotalPriceWithExpense($salesPlanId)
    {
        $sales_plan_total = 0;
        $sales_plan_total = SalesPlanInstallments::where('sales_plan_id', $salesPlanId)->sum('amount');
        // $salesPlan = SalesPlan::select('total_price')->find($salesPlanId);
        // $expense = SalesPlanInstallments::where(['sales_plan_id' => $salesPlanId, 'type' => 'additional_expense'])->get();

        // if (isset($expense) && count($expense) > 0) {
        //     $expense_amount = collect($expense)->sum('amount');
        //     $sales_plan_total = (float)$expense_amount + (float)$salesPlan->total_price;
        // } else {
        //     $sales_plan_total = $salesPlan->total_price;
        // }

        return $sales_plan_total;
    }
}

if (!function_exists('getAccountHeadBalance')) {
    function getAccountHeadBalance($accountHead, $level, $start_date = '', $end_date = '')
    {

        $balance = 0;

        if ($start_date != '' && $end_date != '') {
            $debit = AccountLedger::whereRaw('account_head_code Like (?)', $accountHead->code . '%')->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
            $credit = AccountLedger::whereRaw('account_head_code Like (?)', $accountHead->code . '%')->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        } else {
            $debit = AccountLedger::whereRaw('account_head_code Like (?)', $accountHead->code . '%')->sum('debit');
            $credit = AccountLedger::whereRaw('account_head_code Like (?)', $accountHead->code . '%')->sum('credit');
        }


        $balance = 0;
        if ($accountHead->account_type == 'debit') {
            $balance = $debit - $credit;
        } else {
            $balance = $credit - $debit;
        }



        // switch ($level) {
        //     case 2:
        //         if ($start_date != '') {
        //             if ($end_date != '') {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 5) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
        //                 // sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 5) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        //             }
        //             //in case of only start date
        //             else {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 5) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 5) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('credit');
        //             }
        //         } else {
        //             $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 5) = (?)', $accountHead->code)->sum('debit');
        //             $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 5) = (?)', $accountHead->code)->sum('credit');
        //         }
        //         break;

        //     case 3:
        //         if ($start_date != '') {
        //             if ($end_date != '') {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 7) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 7) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        //             } else {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 7) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 7) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('credit');
        //             }
        //         } else {
        //             $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 7) = (?)', $accountHead->code)->sum('debit');
        //             $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 7) = (?)', $accountHead->code)->sum('credit');
        //         }
        //         break;

        //     case 4:
        //         if ($start_date != '') {
        //             if ($end_date != '') {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 11) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 11) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        //             } else {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 11) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 11) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('credit');
        //             }
        //         } else {
        //             $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 11) = (?)', $accountHead->code)->sum('debit');
        //             $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 11) = (?)', $accountHead->code)->sum('credit');
        //         }
        //         break;

        //         //Level 1
        //     default:
        //         if ($start_date != '') {
        //             if ($end_date != '') {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 3) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 3) = (?)', $accountHead->code)->whereDate('created_date', '>=', $start_date)->whereDate('created_date', '<=', $end_date)->sum('credit');
        //             } else {
        //                 $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 3) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('debit');
        //                 $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 3) = (?)', $accountHead->code)->whereDate('created_date', '=', $start_date)->sum('credit');
        //             }
        //         } else {
        //             $debit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 3) = (?)', $accountHead->code)->sum('debit');
        //             $credit = (new AccountLedger())->whereRaw('substr(account_head_code, 0, 3) = (?)', $accountHead->code)->sum('credit');
        //         }
        //         break;
        // }

        // if ($accountHead->account_type == 'debit') {
        //     $balance = (float) $debit - (float) $credit;
        // } else {
        //     $balance = (float) $credit - (float) $debit;
        // }

        return $balance;
    }
}

if (!function_exists('getValue')) {
    function getValue($new, $key)
    {
        if ($key == 'user_id' || $key == 'checked_by' || $key == 'approved_by' || $key == 'dis_approved_by' || $key == 'reverted_by') {
            $value = User::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'status_id') {
            $value = Unit::find($new);

            return $new . ' ' . '(<span style="color:#7367F0">' . $value->status->name . '</span>)';
        } elseif ($key == 'unit_id') {
            $value = Unit::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'stakeholder_id') {
            $value = Stakeholder::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->full_name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'floor_id') {
            $value = Floor::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'type_id') {
            $value = Type::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'sales_plan_id') {
            $value = SalesPlan::find($new);

            return $new . ' ' . '(<span style="color:#7367F0">' . $value->doc_no . '</span>)';
        } elseif ($key == 'status') {
            if ($new == 0) {
                return $new . ' ' . '(<span style="color:#7367F0">' . 'Pending' . '</span>)';
            } elseif ($new == 1) {
                return $new . ' ' . '(<span style="color:#7367F0">' . 'Approved' . '</span>)';
            } elseif ($new == 2) {
                return $new . ' ' . '(<span style="color:#7367F0">' . 'Disapproved' . '</span>)';
            } elseif ($new == 3) {
                return $new . ' ' . '(<span style="color:#7367F0">' . 'Cancelled' . '</span>)';
            } else {
                return $new . ' ' . '(<span style="color:#7367F0">' . 'Expired' . '</span>)';
            }
        } elseif ($key == 'receipt_id') {
            $value = Receipt::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->doc_no . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'bank_id') {
            $value = Bank::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'lead_source_id') {
            $value = LeadSource::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'account_action_id') {
            $value = AccountAction::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . '</span>)';
            } else {
                return $new;
            }
        } elseif ($key == 'file_action_id') {
            $value = FileAction::find($new);
            if ($value != null) {
                return $new . ' ' . '(<span style="color:#7367F0">' . $value->name . ')';
            } else {
                return $new;
            }
        } elseif ($key == 'created_at' || $key == 'updated_at' || $key == 'deleted_at' || $key == 'created_date' || $key == 'checked_date' || $key == 'approved_date' || $key == 'dis_approved_date' || $key == 'last_paid_at' || $key == 'reverted_date' || $key == 'cheque_active_date' || $key == 'agreement_date') {
            return editDateColumn($new);
        }
    }
}

// check site communication channel access
if (!function_exists('checkSiteComChannelAccess')) {
    function checkSiteComChannelAccess($site_id, $channel)
    {
        $com_channel = (new CommunicationChannel())->where('site_id', $site_id)->where('type', $channel)->where('status', 1)->first();
        if ($com_channel) {
            return true;
        }

        return false;
    }
}

// set env
if (!function_exists('setEnv')) {
    function set_env(string $key, string $value, $env_path = null)
    {
        $value = preg_replace('/\s+/', '', $value); //replace special ch
        $key = strtoupper($key); //force upper for security
        $env = file_get_contents(isset($env_path) ? $env_path : base_path('.env')); //fet .env file
        $env = str_replace("$key=" . env($key), "$key=" . $value, $env); //replace value
        /** Save file eith new content */
        $env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);

        Artisan::call('optimize:clear');
        Artisan::call('config:cache');
        Artisan::call('optimize:clear');
    }
}

// replace sms body
if (!function_exists('replaceSMSBody')) {
    function replaceSMSBody($stakeholder, $body)
    {
        //Replace full_name
        $body = str_replace('{{full_name}}', $stakeholder->full_name, $body);
        //Replace contact
        $body = str_replace('{{contact}}', '+' . $stakeholder->login_contact, $body);
        //Replace cnic
        $body = str_replace('{{cnic}}', $stakeholder->cnic, $body);
        //Replace email
        $body = str_replace('{{email}}', $stakeholder->email, $body);
        //Replace address
        $body = str_replace('{{address}}', $stakeholder->residential_address, $body);

        return $body;
    }
}

// send Twilio SMS on  Salesplan Action
if (!function_exists('sendSmsOnCommunicationChannelAction')) {
    function sendSmsOnCommunicationChannelAction($modal, $action, $site_id, $short_code)
    {
        switch ($short_code) {
            case 'opportunity':
                $stakeholder = Stakeholder::find($modal->assigned_to);

                break;
            case 'saleplan':
                $stakeholder = $modal->stakeholder;
                break;
            case 'receipt':
                $stakeholder = $modal->salesPlan->stakeholder;
                break;
            case 'rebate-incentive':
                $stakeholder = $modal->dealer;
                break;
            case 'send-external-stakeholder-online-signatures':

                if (isset($modal->stakeholder_id)) {
                    $stakeholder = $modal->stakeholder;
                } elseif (isset($modal->kin_id)) {
                    $stakeholder = $modal->stakeholderKin;
                } elseif (isset($modal->stakeholder_contact_id)) {

                    $stakeholder = $modal->stakeholderContacts;
                }

                break;
            case 'payment-voucher':
                if ($modal->stakeholder_type == 'C') {
                    $stakeholder_id = $modal->customer_id;
                }
                if ($modal->stakeholder_type == 'D') {
                    $stakeholder_id = $modal->dealer_id;
                }
                if ($modal->stakeholder_type == 'V') {
                    $stakeholder_id = $modal->vendor_id;
                }
                if ($modal->stakeholder_type == 'I') {
                    $stakeholder_id = $modal->investor_id;
                }
                if ($modal->stakeholder_type == 'R') {
                    $stakeholder_id = $modal->adc_rent_id;
                }
                $stakeholder = (new Stakeholder())->find($stakeholder_id);
            default:
                // code...
                break;
        }

        if (isset($stakeholder)) {

            $to = $stakeholder->login_contact;
            if (Str::length($to) > 0 && isset($to[0]) && $to[0] != '+') {
                $to = '+' . $to;
            }
            // $to = '+923185405672';
            $communicationChannelAction = (new CommunicationChannelAction())->where('slug', $action)->first();
            // Log::alert($action);
            if ($communicationChannelAction) {
                // Log::alert($communicationChannelAction->name);
                $SmsCommunicationsTemplate = (new SmsCommunicationsTemplates())->where('communication_channel_action_id', $communicationChannelAction->id)->where('status', true)
                    ->where('isActive', true)->first();
                if ($SmsCommunicationsTemplate) {

                    switch ($short_code) {
                        case 'opportunity':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal);

                            break;
                        case 'saleplan':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal);
                            break;
                        case 'receipt':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal, true);
                            break;
                        case 'rebate-incentive':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal);
                            break;
                        case 'send-external-stakeholder-online-signatures':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal);
                            break;
                        case 'payment-voucher':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal);
                            break;
                        case 'reminder-notice':
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal, true);
                            break;
                        default:
                            $body = getTemplateBody($SmsCommunicationsTemplate, $modal);
                            break;
                    }
                    if (isset($body)) {
                        $com_channel = (new CommunicationChannel())->where('site_id', $site_id)->where('type', 'sms')->where('status', true)
                            ->where('isActive', true)->first();

                        if (isset($com_channel) && isset($to)) {
                            if (!auth()->user()) {
                                $system = User::where('email', 'system@system.com')->first();
                                $authId = $system->id;
                            } else {
                                $authId = auth()->user()->id;
                            }
                            if ($short_code == 'opportunity') {
                                sendleadtwilioSMS($to, $body, $authId, $com_channel, $communicationChannelAction->id, $modal, $site_id, $SmsCommunicationsTemplate, null);
                            } else {
                                SendSmsJob::dispatch($to, $body, $authId, $com_channel, $communicationChannelAction->id, $modal, $site_id, $SmsCommunicationsTemplate, null);
                            }
                        }
                    }
                }
            }
        }
    }
}
if (!function_exists('sendleadtwilioSMS')) {
    function sendleadtwilioSMS($to, $body, $authId, $com_channel, $com_channel_action_id, $modal, $site_id, $SmsCommunicationsTemplate, $commChannelNotificationObj = null)
    {
        // Log::info('sendleadtwilioSMS');
        // Log::info('status: ' . $com_channel->twilio_status);
        if ($com_channel->twilio_status) {
            $response = null;
            if (!isset($commChannelNotificationObj)) {
                $commChannelNotification = new CommunicationChannelNotification();
                $commChannelNotification->site_id = $site_id;
                $commChannelNotification->communication_channel_action_id = $com_channel_action_id;
                $commChannelNotification->channel_type = 'sms-twilio';
                $modal->notifications()->save($commChannelNotification);
                // Log::info('SmsCommunicationsTemplate: ' . $SmsCommunicationsTemplate->send_action);
                if ($SmsCommunicationsTemplate->send_action == 1) {
                    $from = $com_channel->twilio_number;
                    $client = new Client($com_channel->twilio_sid, $com_channel->twilio_auth_token);
                    // Log::info('to: ' . $to);
                    $response = $client->messages->create(
                        $to,
                        ['from' => $com_channel->twilio_number, 'body' => $body]
                    );
                } else {
                    $commChannelNotification->update([
                        'is_sent' => false,
                    ]);
                }
            } else {
                $from = $com_channel->twilio_number;
                $client = new Client($com_channel->twilio_sid, $com_channel->twilio_auth_token);
                // Log::info('to: ' . $to);

                $response = $client->messages->create(
                    $to,
                    ['from' => $com_channel->twilio_number, 'body' => $body]
                );
                $commChannelNotificationObj->update([
                    'is_sent' => true,
                ]);
            }

            if (isset($response)) {
                SmsTracking::create([
                    'status' => $response->status,
                    'to' => $response->to,
                    'from' => $response->from,
                    'message' => $response->body,
                    'user_id' => $authId,
                    'accountSid' => $response->accountSid,
                    'sid' => $response->sid,
                ]);
            }
        }
    }
}
// send email on communication channel actions
//HINTS:
//$short_code => 'saleplan' for SalePlan, 'receipt' for Receipt
if (!function_exists('sendEmailOnCommunicationChannelAction')) {
    function sendEmailOnCommunicationChannelAction($modal, $action, $site_id, $short_code, $email = null)
    {
        switch ($short_code) {
            case 'directors-report':
                if (isset($email)) {
                    $stakeholderEmail = $email;
                }
                break;
            case 'recovery-report':
                if (isset($email)) {
                    $stakeholderEmail = $email;
                }
                break;
            case 'recovery-reminder-for-internal-stakeholders':
                if (isset($email)) {
                    $stakeholderEmail = $email;
                }
                break;
            case 'saleplan':
                $stakeholderEmail = $modal->stakeholder->stakeholder_as = 'i' ? $modal->stakeholder->email : $modal->stakeholder->office_email;
                break;
            case 'receipt':
                $stakeholderEmail = $modal->salesPlan->stakeholder->stakeholder_as = 'i' ? $modal->salesPlan->stakeholder->email : $modal->salesPlan->stakeholder->office_email;
                break;
            case 'rebate-incentive':
                $stakeholderEmail = $modal->dealer->stakeholder_as = 'i' ? $modal->dealer->email : $modal->dealer->office_email;
                break;
            case 'send-external-stakeholder-online-signatures':

                if (isset($modal->stakeholder_id)) {
                    $stakeholder = $modal->stakeholder;
                } elseif (isset($modal->kin_id)) {
                    $stakeholder = $modal->stakeholderKin;
                } elseif (isset($modal->stakeholder_contact_id)) {

                    $stakeholder = $modal->stakeholderContacts;
                }

                $stakeholderEmail = $stakeholder->stakeholder_as = 'i' ? $stakeholder->email : $stakeholder->office_email;
                break;
            case 'payment_voucher':
                if ($modal->stakeholder_type == 'C') {
                    $stakeholder_id = $modal->customer_id;
                }
                if ($modal->stakeholder_type == 'D') {
                    $stakeholder_id = $modal->dealer_id;
                }
                if ($modal->stakeholder_type == 'V') {
                    $stakeholder_id = $modal->vendor_id;
                }
                if ($modal->stakeholder_type == 'I') {
                    $stakeholder_id = $modal->investor_id;
                }
                if ($modal->stakeholder_type == 'R') {
                    $stakeholder_id = $modal->adc_rent_id;
                }
                $stakeholder = (new Stakeholder())->find($stakeholder_id);
                $stakeholderEmail = $stakeholder->stakeholder_as = 'i' ? $stakeholder->email : $stakeholder->office_email;
                break;
            case 'subscriber':
                $stakeholderEmail = $modal->email;
                break;
            case 'reminder-notice':
                $stakeholderEmail = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->email : $modal->stakeholder->office_email;
                break;
            default:
                // code...
                break;
        }
        $com_channel = (new CommunicationChannel())->where('site_id', $site_id)->where('type', 'email')->where('status', true)
            ->where('isActive', true)->first();
        // $stakeholderEmail = 'farzam.islootech@gmail.com';

        if (isset($com_channel) && isset($stakeholderEmail)) {
            $channelAction = (new CommunicationChannelAction())->where('slug', $action)->first();

            if (isset($channelAction)) {
                // log::alert($channelAction->name);
                $emailCommTemplate = EmailCommunicationTemplate::where('communication_channel_action_id', $channelAction->id)->where('isActive', true)->first();
                if ($emailCommTemplate && $emailCommTemplate->status == 1) {

                    $commChannelNotification = new CommunicationChannelNotification;
                    $commChannelNotification->site_id = $site_id;
                    $commChannelNotification->communication_channel_action_id = $channelAction->id;
                    $commChannelNotification->channel_type = 'email';
                    $modal->notifications()->save($commChannelNotification);

                    if ($emailCommTemplate->send_action == 1) {
                        Mail::to($stakeholderEmail)->send(new AllCommunicationChannelMail($modal, $channelAction->id));
                    } else {
                        $commChannelNotification->update([
                            'is_sent' => false,
                        ]);
                    }
                }
            }
        }
    }
}

// template Body
if (!function_exists('getPromotionalEmailTemplateBody')) {
    function getPromotionalEmailTemplateBody($template, $stakeholder)
    {
        $body = $template->description;

        //Replace full_name
        $body = str_replace('{{full_name}}', $stakeholder->full_name, $body);
        // Replace father_name
        $body = str_replace('{{father_name}}', $stakeholder->father_name ?? '', $body);
        // Replace contact
        $contact = $stakeholder->stakeholder_as == 'i' ? $stakeholder->mobile_contact : $stakeholder->office_contact;
        $body = str_replace('{{contact}}', $contact, $body);
        //Replace cnic
        $body = str_replace('{{cnic}}', $stakeholder->cnic ?? '', $body);
        //Replace address
        $body = str_replace('{{address}}', $stakeholder->residential_address ?? '', $body);
        //Replace email
        $email = $stakeholder->stakeholder_as == 'i' ? $stakeholder->email : $stakeholder->office_email;
        $body = str_replace('{{email}}', $email, $body);

        return $body;
    }
}

if (!function_exists('getTempPromotionalEmailTemplateBody')) {
    function getTempPromotionalEmailTemplateBody($template, $stakeholder)
    {
        // printf($template->description);
        $body = $template->description;

        //Replace full_name
        $body = str_replace('{{full_name}}', $stakeholder->name ?? '', $body);
        $body = str_replace('{{father_name}}', '', $body);
        $body = str_replace('{{cnic}}', '', $body);
        $body = str_replace('{{address}}', '', $body);
        // Replace contact
        $contact = $stakeholder->phone ?? '';
        $body = str_replace('{{contact}}', $contact, $body);

        //Replace email
        $email = $stakeholder->email ?? '';
        $body = str_replace('{{email}}', $email, $body);

        return $body;
    }
}
// template Body
if (!function_exists('getTemplateBody')) {
    function getTemplateBody($template, $modal, $is_shortcode = false, $view = false)
    {
        // Log::info('Action: ' . $template->action->name);
        $modals_name = get_class($modal);
        $body = $template->description;
        switch ($modals_name) {
            case 'App\Models\StakeholderRecoveryHistory':
                // code...
                if ($is_shortcode) {
                } else {
                    $body = $template->description;
                    $body = str_replace('{{full_name}}', $modal->stakeholder->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $modal->stakeholder->father_name ?? '', $body);
                    // Replace contact
                    $contact = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->mobile_contact : $modal->stakeholder->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $modal->stakeholder->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $modal->stakeholder->residential_address ?? '', $body);
                    //Replace email
                    $email = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->email : $modal->stakeholder->office_email;
                    $body = str_replace('{{email}}', $email, $body);
                    //Replace Internal Stakeholder name
                    $body = str_replace('{{internal_stakeholder_name}}', $modal->user->name, $body);
                    //Replace remarks
                    $body = str_replace('{{internal_stakeholder_remarks_for_recovery}}', $modal->comments, $body);
                }
                break;
            case 'App\Models\DirectorReportPdf':
                $body = $template->description;
                $attachment = $modal->path;
                break;
            case 'App\Models\SalesPlan':
                // code...
                if ($is_shortcode) {
                    if ($template->action->slug == 'reminder-notice-on-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 0) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 7 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 7 day"));
                        }

                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'first-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 8) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 15 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 15 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'second-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 23) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 30 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 30 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'third-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 38) {

                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 45 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 45 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    }

                    $body = [
                        'name' => $modal->stakeholder->full_name, 'unitno' => $modal->unit->name, 'docNo' => $modal->doc_no, 'price' => $modal->total_price,
                        'customer_name' => $modal->stakeholder->full_name, 'amount' => numberFormat($modal->dueAmount->remaining_amount), 'unit_no' => $modal->unit->name, 'expiry_date' => $expiry_date
                    ];

                    // for sms using Lifetime
                    $body = json_encode($body);
                } else if ($view == true) {
                    $body = $template->description;
                    //Replace full_name
                    $body = str_replace('{{full_name}}', $modal->stakeholder->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $modal->stakeholder->father_name ?? '', $body);
                    // Replace contact
                    $contact = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->mobile_contact : $modal->stakeholder->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $modal->stakeholder->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $modal->stakeholder->residential_address ?? '', $body);
                    //Replace email
                    $email = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->email : $modal->stakeholder->office_email;
                    $body = str_replace('{{email}}', $email, $body);

                    //Replace doc_no
                    $body = str_replace('{{doc_no}}', $modal->doc_no, $body);
                    //Replace approver
                    $body = str_replace('{{approver}}', $modal->approveBy->name ?? '', $body);
                    // Replace proposed_plan_no
                    $body = str_replace('{{proposed_plan_no}}', $modal->investment_plan_serial_id, $body);
                    // Replace payment_plan_no
                    $body = str_replace('{{payment_plan_no}}', $modal->payment_plan_serial_id ?? '', $body);
                    // Replace total_amount
                    $body = str_replace('{{total_amount}}', numberFormat($modal->total_price, 2), $body);
                    // Replace down_payment
                    $body = str_replace('{{down_payment}}', numberFormat($modal->down_payment_total, 2), $body);
                    // Replace creation_date
                    $body = str_replace('{{creation_date}}', Carbon::parse($modal->created_date)->format('d-m-Y'), $body);
                    // Replace validity_date
                    $body = str_replace('{{validity_date}}', Carbon::parse($modal->validity)->format('d-m-Y'), $body);
                    // Replace total_installments
                    $installments = SalesPlanInstallments::where('sales_plan_id', $modal->id);
                    // dd( $modal->id);
                    $body = str_replace('{{total_installments}}', $installments->count(), $body);
                    // Replace total_paid_installments
                    $body = str_replace('{{total_paid_installments}}', $installments->whereIn('status', ['paid', 'partially_paid'])->count(), $body);
                    // Replace total_unpaid_installments
                    $body = str_replace('{{total_unpaid_installments}}', $installments->where('status', '!=', 'paid')->count(), $body);
                    // Replace total_due_installments
                    $body = str_replace('{{total_due_installments}}', $installments->where('date', '<', date('Y-m-d'))->whereIn('status', ['unpaid', 'partially_paid'])->count(), $body);

                    $body = str_replace('{{total_due_amount}}', numberFormat($modal->dueAmount->remaining_amount), $body);

                    $body = str_replace('{{last_installment_due_date}}', $modal->getLastDueinstallment->date, $body);

                    if ($template->action->slug == 'reminder-notice-on-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 0) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 7 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 7 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'first-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 8) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 15 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 15 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'second-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 23) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 30 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 30 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'third-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 38) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 45 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 45 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    }

                    // replace unit_short_label
                    $body = str_replace('{{unit_short_label}}', $modal->unit->floor_unit_number, $body);
                    // replace unit_name
                    $body = str_replace('{{unit_name}}', $modal->unit->name, $body);
                    // replace floor_short_label
                    $body = str_replace('{{floor_short_label}}', $modal->unit->floor->short_label, $body);
                    // replace floor_name
                    $body = str_replace('{{floor_name}}', $modal->unit->floor->name, $body);
                    // replace gross_area
                    $body = str_replace('{{gross_area}}', $modal->unit->gross_area, $body);
                    // replace net_area
                    $body = str_replace('{{net_area}}', $modal->unit->net_area, $body);
                    // replace price_per_sqft
                    $body = str_replace('{{price_per_sqft}}', $modal->unit->price_sqft, $body);
                } else {
                    $body = $template->description;
                    //Replace full_name
                    $body = str_replace('{{full_name}}', $modal->stakeholder->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $modal->stakeholder->father_name ?? '', $body);
                    // Replace contact
                    $contact = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->mobile_contact : $modal->stakeholder->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $modal->stakeholder->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $modal->stakeholder->residential_address ?? '', $body);
                    //Replace email
                    $email = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->email : $modal->stakeholder->office_email;
                    $body = str_replace('{{email}}', $email, $body);

                    //Replace doc_no
                    $body = str_replace('{{doc_no}}', $modal->doc_no, $body);
                    //Replace approver
                    $body = str_replace('{{approver}}', $modal->approveBy->name ?? '', $body);
                    // Replace proposed_plan_no
                    $body = str_replace('{{proposed_plan_no}}', $modal->investment_plan_serial_id, $body);
                    // Replace payment_plan_no
                    $body = str_replace('{{payment_plan_no}}', $modal->payment_plan_serial_id ?? '', $body);
                    // Replace total_amount
                    $body = str_replace('{{total_amount}}', numberFormat($modal->total_price, 2), $body);
                    // Replace down_payment
                    $body = str_replace('{{down_payment}}', numberFormat($modal->down_payment_total, 2), $body);
                    // Replace creation_date
                    $body = str_replace('{{creation_date}}', Carbon::parse($modal->created_date)->format('d-m-Y'), $body);
                    // Replace validity_date
                    $body = str_replace('{{validity_date}}', Carbon::parse($modal->validity)->format('d-m-Y'), $body);
                    // Replace total_installments
                    $installments = SalesPlanInstallments::where('sales_plan_id', $modal->id);
                    // dd( $modal->id);
                    $body = str_replace('{{total_installments}}', $installments->count(), $body);
                    // Replace total_paid_installments
                    $body = str_replace('{{total_paid_installments}}', $installments->whereIn('status', ['paid', 'partially_paid'])->count(), $body);
                    // Replace total_unpaid_installments
                    $body = str_replace('{{total_unpaid_installments}}', $installments->where('status', '!=', 'paid')->count(), $body);
                    // Replace total_due_installments
                    $body = str_replace('{{total_due_installments}}', $installments->where('date', '<', date('Y-m-d'))->whereIn('status', ['unpaid', 'partially_paid'])->count(), $body);

                    $body = str_replace('{{total_due_amount}}', numberFormat($modal->dueAmount->remaining_amount), $body);

                    $body = str_replace('{{last_installment_due_date}}', $modal->getLastDueinstallment->date, $body);

                    if ($template->action->slug == 'reminder-notice-on-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 0) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 7 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 7 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'first-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 8) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 15 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 15 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'second-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 23) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 30 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 30 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    } elseif ($template->action->slug == 'third-reminder-notice-after-due-date') {
                        $date_difference_in_days = (int)date_diff(date_create($modal->getLastDueinstallment->date), date_create(now()))->format('%a');
                        if ($date_difference_in_days == 38) {
                            $expiry_date =   date('d-m-Y', strtotime($modal->getLastDueinstallment->date . " + 45 day"));
                        } else {
                            $expiry_date = date('d-m-Y', strtotime(now() . " + 45 day"));
                        }
                        $body = str_replace('{{reminder_expiry_date}}', $expiry_date, $body);
                    }

                    // replace unit_short_label
                    $body = str_replace('{{unit_short_label}}', $modal->unit->floor_unit_number, $body);
                    // replace unit_name
                    $body = str_replace('{{unit_name}}', $modal->unit->name, $body);
                    // replace floor_short_label
                    $body = str_replace('{{floor_short_label}}', $modal->unit->floor->short_label, $body);
                    // replace floor_name
                    $body = str_replace('{{floor_name}}', $modal->unit->floor->name, $body);
                    // replace gross_area
                    $body = str_replace('{{gross_area}}', $modal->unit->gross_area, $body);
                    // replace net_area
                    $body = str_replace('{{net_area}}', $modal->unit->net_area, $body);
                    // replace price_per_sqft
                    $body = str_replace('{{price_per_sqft}}', $modal->unit->price_sqft, $body);
                }
                break;
            case 'App\Models\RebateIncentiveModel':
                // code...
                if ($is_shortcode) {
                    $body = ['name' => $modal->dealer->full_name, 'unitno' => $modal->unit->floor_unit_number, 'docNo' => $modal->doc_no];
                    $body = json_encode($body);
                } else {
                    $body = $template->description;
                    //Replace full_name
                    $body = str_replace('{{full_name}}', $modal->dealer->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $modal->dealer->father_name ?? '', $body);
                    // Replace contact
                    $contact = $modal->dealer->stakeholder_as == 'i' ? $modal->dealer->mobile_contact : $modal->dealer->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $modal->dealer->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $modal->dealer->residential_address ?? '', $body);
                    //Replace email
                    $email = $modal->dealer->stakeholder_as == 'i' ? $modal->dealer->email : $modal->dealer->office_email;
                    $body = str_replace('{{email}}', $email, $body);

                    //Replace doc_no
                    $body = str_replace('{{doc_no}}', $modal->doc_no, $body);
                    //Replace approver
                    $body = str_replace('{{approver}}', $modal->approveBy->name ?? '', $body);
                    // Replace creation_date
                    $body = str_replace('{{creation_date}}', Carbon::parse($modal->created_date)->format('d-m-Y'), $body);
                    // replace unit_short_label
                    $body = str_replace('{{unit_short_label}}', $modal->unit->floor_unit_number, $body);
                    // replace unit_name
                    $body = str_replace('{{unit_name}}', $modal->unit->name, $body);
                    // replace floor_short_label
                    $body = str_replace('{{floor_short_label}}', $modal->unit->floor->short_label, $body);
                    // replace floor_name
                    $body = str_replace('{{floor_name}}', $modal->unit->floor->name, $body);
                    // replace gross_area
                    $body = str_replace('{{gross_area}}', $modal->unit->gross_area, $body);
                    // replace net_area
                    $body = str_replace('{{net_area}}', $modal->unit->net_area, $body);
                    // replace price_per_sqft
                    $body = str_replace('{{price_per_sqft}}', $modal->unit->price_sqft, $body);
                }
                break;
            case 'App\Models\Receipt':
                // code...
                $salePlan = $modal->salesPlan;
                if ($is_shortcode) {
                    $body = ['customer_name' => $salePlan->stakeholder->full_name, 'unit_no' => $salePlan->unit->name, 'amount' => numberFormat($modal->amount_received), 'price' => numberFormat($salePlan->total_price)];
                    $body = json_encode($body);
                } else {
                    $body = $template->description;
                    //Replace full_name
                    $body = str_replace('{{full_name}}', $salePlan->stakeholder->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $salePlan->stakeholder->father_name ?? '', $body);
                    // Replace contact
                    $contact = $salePlan->stakeholder->stakeholder_as == 'i' ? $salePlan->stakeholder->mobile_contact : $salePlan->stakeholder->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $salePlan->stakeholder->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $salePlan->stakeholder->residential_address ?? '', $body);
                    //Replace email
                    // $email = $salePlan->stakeholder->stakeholder_as == 'i' ? $salePlan->stakeholder->email  : $salePlan->stakeholder->office_email;
                    $body = str_replace('{{email}}', $salePlan->stakeholder->email, $body);

                    //Replace doc_no
                    $body = str_replace('{{doc_no}}', $salePlan->doc_no, $body);
                    //Replace approver
                    $body = str_replace('{{approver}}', $salePlan->approveBy->name ?? '', $body);
                    // Replace proposed_plan_no
                    $body = str_replace('{{proposed_plan_no}}', $salePlan->investment_plan_serial_id, $body);
                    // Replace payment_plan_no
                    $body = str_replace('{{payment_plan_no}}', $salePlan->payment_plan_serial_id ?? '', $body);
                    // Replace total_amount
                    $body = str_replace('{{total_amount}}', numberFormat($salePlan->total_price, 2), $body);
                    // Replace down_payment
                    $body = str_replace('{{down_payment}}', numberFormat($salePlan->down_payment_total, 2), $body);
                    // Replace creation_date
                    $body = str_replace('{{creation_date}}', Carbon::parse($salePlan->created_date)->format('d-m-Y'), $body);
                    // Replace validity_date
                    $body = str_replace('{{validity_date}}', Carbon::parse($salePlan->validity)->format('d-m-Y'), $body);
                    // Replace total_installments
                    $installments = SalesPlanInstallments::where('sales_plan_id', $salePlan->id);
                    // dd( $salePlan->id);
                    $body = str_replace('{{total_installments}}', $installments->count(), $body);
                    // Replace total_paid_installments
                    $body = str_replace('{{total_paid_installments}}', $installments->whereIn('status', ['paid', 'partially_paid'])->count(), $body);
                    // Replace total_unpaid_installments
                    $body = str_replace('{{total_unpaid_installments}}', $installments->whereIn('status', ['unpaid', 'partially_paid'])->count(), $body);
                    // Replace total_due_installments
                    $body = str_replace('{{total_due_installments}}', $installments->where('date', '<', date('Y-m-d'))->whereIn('status', ['unpaid', 'partially_paid'])->count(), $body);

                    // replace unit_short_label
                    $body = str_replace('{{unit_short_label}}', $salePlan->unit->floor_unit_number, $body);
                    // replace unit_name
                    $body = str_replace('{{unit_name}}', $salePlan->unit->name, $body);
                    // replace floor_short_label
                    $body = str_replace('{{floor_short_label}}', $salePlan->unit->floor->short_label, $body);
                    // replace floor_name
                    $body = str_replace('{{floor_name}}', $salePlan->unit->floor->name, $body);
                    // replace gross_area
                    $body = str_replace('{{gross_area}}', $salePlan->unit->gross_area, $body);
                    // replace net_area
                    $body = str_replace('{{net_area}}', $salePlan->unit->net_area, $body);
                    // replace price_per_sqft
                    $body = str_replace('{{price_per_sqft}}', $salePlan->unit->price_sqft, $body);

                    // replce receipt doc_no
                    $body = str_replace('{{rec_doc_no}}', $modal->doc_no, $body);
                    // replce mod$modal amount_received
                    $body = str_replace('{{amount_received}}', numberFormat($modal->amount_received), $body);
                    // replace mod$modal mode_of_payemnt
                    $body = str_replace('{{mode_of_payment}}', $modal->mode_of_payment, $body);
                }
                break;
            case 'App\Models\FileSignature':
                // code...

                if (isset($modal->stakeholder_id)) {
                    $stakeholder = $modal->stakeholder;
                } elseif (isset($modal->kin_id)) {
                    $stakeholder = $modal->stakeholderKin;
                } elseif (isset($modal->stakeholder_contact_id)) {

                    $stakeholder = $modal->stakeholderContacts;
                }

                if ($is_shortcode) {
                    $body = ['name' => $stakeholder->full_name, 'email' => $stakeholder->email, 'cnic' => $stakeholder->cnic, 'contact' => $stakeholder->mobile_contact, 'address' => $stakeholder->residential_address, 'father_name' => $stakeholder->father_name];
                    $body = json_encode($body);
                } else {
                    $body = $template->description;
                    //Replace full_name
                    $body = str_replace('{{full_name}}', $stakeholder->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $stakeholder->father_name ?? '', $body);
                    // Replace contact
                    $contact = $stakeholder->stakeholder_as == 'i' ? $stakeholder->mobile_contact : $stakeholder->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $stakeholder->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $stakeholder->residential_address ?? '', $body);
                    //Replace email
                    // $email = $stakeholder->stakeholder_as == 'i' ? $stakeholder->email  : $stakeholder->office_email;
                    $body = str_replace('{{email}}', $stakeholder->email, $body);
                    // Replace url
                    $body = str_replace('{{online_signature_url}}', $modal->url, $body);
                }
                break;

            case 'App\Models\CrmOppertunity':

                $body = $template->description;

                $body = str_replace('{{title}}', $modal->name, $body);
                $body = str_replace('{{op_no}}', $modal->unique_opportunity_no ?? '', $body);
                $body = str_replace('{{lead_name}}', $modal->assigned->full_name ?? '', $body);
                $body = str_replace('{{full_name}}', $modal->assigned->full_name ?? '', $body);
                $body = str_replace('{{lead_contact_no}}', $modal->assigned->login_contact ?? '', $body);
                $body = str_replace('{{lead_contact_email}}', $modal->assigned->email ?? '', $body);

                break;
            case 'App\Models\User':

                $body = $template->description;

                //Replace full_name
                $body = str_replace('{{full_name}}', $modal->name, $body);
                // Replace father_name
                $body = str_replace('{{father_name}}', $modal->father_name ?? '', $body);
                // Replace contact
                $contact = $modal->contact;
                $body = str_replace('{{contact}}', $contact, $body);
                //Replace cnic
                $body = str_replace('{{cnic}}', $modal->cnic ?? '', $body);
                //Replace address
                $body = str_replace('{{address}}', $modal->address ?? '', $body);

                $email = $modal->email;
                break;
            case 'App\Models\SalesPlanInstallments':
                // code...
                if ($is_shortcode) {
                    $body = ['name' => $modal->stakeholder->full_name, 'unitno' => $modal->unit->name, 'docNo' => $modal->salesPlan->doc_no ?? '-', 'total_amount' => $modal->amount,  'paid_amount' => $modal->paid_amount, 'due_amount' => $modal->remaining_amount];
                    $body = json_encode($body);
                } else {
                    $body = $template->description;
                    //Replace full_name
                    $body = str_replace('{{full_name}}', $modal->stakeholder->full_name, $body);
                    // Replace father_name
                    $body = str_replace('{{father_name}}', $modal->stakeholder->father_name ?? '', $body);
                    // Replace contact
                    $contact = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->mobile_contact : $modal->stakeholder->office_contact;
                    $body = str_replace('{{contact}}', $contact, $body);
                    //Replace cnic
                    $body = str_replace('{{cnic}}', $modal->stakeholder->cnic ?? '', $body);
                    //Replace address
                    $body = str_replace('{{address}}', $modal->stakeholder->residential_address ?? '', $body);
                    //Replace email
                    $email = $modal->stakeholder->stakeholder_as == 'i' ? $modal->stakeholder->email : $modal->stakeholder->office_email;
                    $body = str_replace('{{email}}', $email, $body);

                    //Replace doc_no
                    $body = str_replace('{{doc_no}}', $modal->doc_no, $body);
                    //Replace approver
                    $body = str_replace('{{approver}}', $modal->approveBy->name ?? '', $body);
                    // Replace proposed_plan_no
                    $body = str_replace('{{proposed_plan_no}}', $modal->investment_plan_serial_id, $body);
                    // Replace payment_plan_no
                    $body = str_replace('{{payment_plan_no}}', $modal->payment_plan_serial_id ?? '', $body);
                    // Replace total_amount
                    $body = str_replace('{{total_amount}}', numberFormat($modal->total_price, 2), $body);
                    // Replace down_payment
                    $body = str_replace('{{down_payment}}', numberFormat($modal->down_payment_total, 2), $body);
                    // Replace creation_date
                    $body = str_replace('{{creation_date}}', Carbon::parse($modal->created_date)->format('d-m-Y'), $body);
                    // Replace validity_date
                    $body = str_replace('{{validity_date}}', Carbon::parse($modal->validity)->format('d-m-Y'), $body);
                    // Replace total_installments
                    $installments = SalesPlanInstallments::where('sales_plan_id', $modal->id);
                    // dd( $modal->id);
                    $body = str_replace('{{total_installments}}', $installments->count(), $body);
                    // Replace total_paid_installments
                    $body = str_replace('{{total_paid_installments}}', $installments->whereIn('status', ['paid', 'partially_paid'])->count(), $body);
                    // Replace total_unpaid_installments
                    $body = str_replace('{{total_unpaid_installments}}', $installments->whereIn('status', ['unpaid', 'partially_paid'])->count(), $body);
                    // Replace total_due_installments
                    $body = str_replace('{{total_due_installments}}', $installments->where('date', '<', date('Y-m-d'))->whereIn('status', ['unpaid', 'partially_paid'])->count(), $body);

                    // replace unit_short_label
                    $body = str_replace('{{unit_short_label}}', $modal->unit->floor_unit_number, $body);
                    // replace unit_name
                    $body = str_replace('{{unit_name}}', $modal->unit->name, $body);
                    // replace floor_short_label
                    $body = str_replace('{{floor_short_label}}', $modal->unit->floor->short_label, $body);
                    // replace floor_name
                    $body = str_replace('{{floor_name}}', $modal->unit->floor->name, $body);
                    // replace gross_area
                    $body = str_replace('{{gross_area}}', $modal->unit->gross_area, $body);
                    // replace net_area
                    $body = str_replace('{{net_area}}', $modal->unit->net_area, $body);
                    // replace price_per_sqft
                    $body = str_replace('{{price_per_sqft}}', $modal->unit->price_sqft, $body);
                }
                break;
            default:
                // code...
                break;
        }

        // dd($body);
        return $body;
    }
}

if (!function_exists('getAttachment')) {

    function getAttachment($model)
    {
        if (isset($model->path)) {
            return $model->path;
        } else {
            return null;
        }
    }
}

if (!function_exists('get_origin_number')) {
    function get_origin_number()
    {
        $origin_number = AccountLedger::get();
        $origin_number = collect($origin_number)->last();
        if (isset($origin_number)) {
            $origin_number = $origin_number->origin_number + 1;
            $existAccoutNumber = AccountLedger::where('origin_number', $origin_number)->exists();
            while ($existAccoutNumber) {
                $origin_number = $origin_number + 1;
                $existAccoutNumber = AccountLedger::where('origin_number', $origin_number)->exists();
            }
            $origin_number = sprintf('%03d', $origin_number);
        } else {
            $origin_number = '001';
        }

        return $origin_number;
    }
}

// getDocumentStatus

if (!function_exists('getDocumentStatus')) {
    function getDocumentStatus($file_id, $type, $onlyInternal = true, $batch_no = 1)
    {
        if ($onlyInternal) {
            $data = [
                'pending' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_internal', true)->where('is_signed', false)->distinct('user_id')->get(),
                'approve' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_internal', true)->where('is_approved', true)->distinct('user_id')->get(),
                'disApprove' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_internal', true)->where('is_disapproved', true)->distinct('user_id')->get(),
                'total' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_internal', true)->distinct('user_id')->get(),
            ];
        } else {
            $data = [
                'pending' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_signed', false)->get(),
                'approve' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_approved', true)->get(),
                'disApprove' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->where('is_disapproved', true)->get(),
                'total' => FileSignature::where('file_id', $file_id)->where('file_type', $type)->where('batch_no', $batch_no)->with('user', 'user.media')->get(),
            ];
        }

        return $data;
    }
}

// Save OneDrive Selected File
if (!function_exists('saveOneDriveFile')) {
    function saveOneDriveFile($file)
    {
        try {
            $file_name = $file['name'];
            $file_size = $file['size'];
            $download_url = $file['@microsoft.graph.downloadUrl'];

            $ch = curl_init($download_url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //  curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);

            $data = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            $error = curl_errno($ch);
            curl_close($ch);

            $path = public_path('/onedrive-files');

            if (!File::isDirectory($path)) {
                File::makeDirectory($path);
            }

            // A file with the same name may exist, that must be handled.
            $file_save_path = $path . '/' . $file_name;

            file_put_contents($file_save_path, $data);

            return $file_name;
        } catch (Exception $e) {
            return -1;
        }
    }
}

// Beautify File Size
if (!function_exists('beautifyFileSize')) {
    function beautifyFileSize($sizeInBytes)
    {
        $size = $sizeInBytes / 1000;
        if ($size >= 1000) {
            $size = $size / 1000;

            return round($size) . 'mb';
        } else {
            return round($size) . 'kb';
        }
    }
}

// Internal stakeholder approvals spatie media in an array
if (!function_exists('approvalsSpatieMediaToArray')) {
    function approvalsSpatieMediaToArray($array = [], $media = [])
    {
        if (isset($media)) {
            foreach ($media as $media_key => $media_item) {
                $document_path = $media_item->getPath();
                if (File::exists($document_path)) {
                    $document_path = url(Str::replace(public_path(), '', $document_path));
                    $size = beautifyFileSize($media_item->size);
                    $extension = pathinfo($document_path, PATHINFO_EXTENSION);
                    array_push($array, [
                        'file_name' => Str::title($media_item->name),
                        'document_path' => $document_path,
                        'document_size' => $size,
                        'document_extension' => $extension,
                    ]);
                }
            }
        }

        return $array;
    }
}

// Receipt Impact for created and checked status
if (!function_exists('receiptImpact')) {
    function receiptImpact($id)
    {
        $receipt = Receipt::find($id);

        $sales_plan = SalesPlan::where('id', $receipt->sales_plan_id)->where('status', 1)->with('PaidorPartiallyPaidInstallments', 'unPaidInstallments', 'stakeholder')->first();
        if (isset($sales_plan)) {
            // $stakeholders = $sales_plan->stakeholder;
            // dd($stakeholders->country->name);
            // $stakeholders->cnic = $stakeholders->cnic;
            $installmentFullyPaidUnderAmount = [];
            $installmentPartialyPaidUnderAmount = [];
            $calculate_amount = 0;
            $to_be_paid_calculate_amount = 0;
            $total_calculated_installments = [];
            $amount_to_be_paid = $receipt->amount_in_numbers;
            $total_installment_required_amount = 0;
            foreach ($sales_plan->unPaidInstallments as $installment) {
                if ($installment->remaining_amount == 0) {
                    $paid_amount = $installment->amount;
                    $total_amount = $installment->amount;
                } else {
                    $paid_amount = $installment->remaining_amount;
                    $total_amount = $installment->amount - $paid_amount;
                }
                $calculate_amount = $calculate_amount + $paid_amount;
                if ($amount_to_be_paid >= $calculate_amount) {
                    $partially_paid = 0;
                    if ($installment->status == 'partially_paid') {
                        $partially_paid = $installment->paid_amount;
                        $paid_amount = $paid_amount + $installment->paid_amount;
                        $remaining_amount = $installment->amount - $paid_amount;
                    }

                    $installmentFullyPaidUnderAmount[] = [
                        'id' => $installment->id,
                        'date' => $installment->date,
                        'amount' => $installment->amount,
                        'paid_amount' => $paid_amount,
                        'remaining_amount' => 0,
                        'installment_order' => $installment->installment_order,
                        'partially_paid' => $partially_paid,
                        'detail' => $installment->details,
                    ];
                } else {
                    foreach ($installmentFullyPaidUnderAmount as $to_be_paid_installments) {
                        if ($to_be_paid_installments['partially_paid'] !== 0) {
                            $to_be_paid_calculate_amount = $to_be_paid_installments['paid_amount'] - $to_be_paid_installments['partially_paid'];
                        } else {
                            $to_be_paid_calculate_amount = $to_be_paid_calculate_amount + $to_be_paid_installments['paid_amount'];
                        }
                    }
                    if ($to_be_paid_calculate_amount < $amount_to_be_paid) {

                        if ($to_be_paid_calculate_amount == 0) {
                            $amount_to_be_paid = $installment->amount - $amount_to_be_paid;
                            $paid_amount = $installment->amount - $amount_to_be_paid;
                            $remaining_amount = $installment->amount - $paid_amount;
                        } else {
                            $paid_amount = $amount_to_be_paid - $to_be_paid_calculate_amount;
                            $remaining_amount = $installment->amount - $paid_amount;
                        }
                        if ($installment->status == 'partially_paid') {
                            $partially_paid = $paid_amount;
                            $paid_amount = $paid_amount + $installment->paid_amount;
                            $remaining_amount = $installment->amount - $paid_amount;
                        }

                        $installmentPartialyPaidUnderAmount[] = [
                            'id' => $installment->id,
                            'date' => Carbon::parse($installment->date)->format('d-m-Y'),
                            'amount' => $installment->amount,
                            'paid_amount' => $paid_amount,
                            'remaining_amount' => $remaining_amount,
                            'installment_order' => $installment->installment_order,
                            'partially_paid' => $installment->paid_amount,
                            'detail' => $installment->details,
                        ];
                    }

                    break;
                }
            }
            foreach ($sales_plan->unPaidInstallments as $installment) {
                if ($installment->status == 'partially_paid') {
                    $total_installment_required_amount = $total_installment_required_amount + $installment->remaining_amount;
                } else {
                    $total_installment_required_amount = $total_installment_required_amount + $installment->amount;
                }
            }

            $already_paid = [];
            foreach ($sales_plan->paidInstallments as $key => $alreadyPaidOnstallment) {
                if ($alreadyPaidOnstallment->status == 'partially_paid') {
                    continue;
                }
                $already_paid[] = [
                    'id' => $alreadyPaidOnstallment->id,
                    'date' => Carbon::parse($alreadyPaidOnstallment->date)->format('d-m-Y'),
                    'amount' => $alreadyPaidOnstallment->amount,
                    'paid_amount' => $alreadyPaidOnstallment->paid_amount,
                    'remaining_amount' => $alreadyPaidOnstallment->remaining_amount,
                    'installment_order' => $alreadyPaidOnstallment->installment_order,
                    'partially_paid' => $alreadyPaidOnstallment->paid_amount,
                    'detail' => $alreadyPaidOnstallment->details,
                ];
            }

            $unpaid = [];
            foreach ($sales_plan->unPaidInstallments as $key => $unPaidOnstallment) {
                if ($unPaidOnstallment->status == 'partially_paid') {
                    continue;
                }
                $unpaid[] = [
                    'id' => $unPaidOnstallment->id,
                    'date' => Carbon::parse($unPaidOnstallment->date)->format('d-m-Y'),
                    'amount' => $unPaidOnstallment->amount,
                    'paid_amount' => $unPaidOnstallment->paid_amount,
                    'remaining_amount' => $unPaidOnstallment->remaining_amount,
                    'installment_order' => $unPaidOnstallment->installment_order,
                    'partially_paid' => $unPaidOnstallment->paid_amount,
                    'detail' => $unPaidOnstallment->details,
                ];
            }

            $total_calculated_installments = array_merge($installmentFullyPaidUnderAmount, $installmentPartialyPaidUnderAmount);

            // $purpose = $installment->details;

            $purpose = [];

            for ($i = 0; $i < count($total_calculated_installments); $i++) {
                $installment = SalesPlanInstallments::find($total_calculated_installments[$i]['id']);

                $purpose[] = $installment->details;
                $total_paid_amount = $amount_to_be_paid + $total_calculated_installments[$i]['paid_amount'];
            }

            // dd($purpose);

            $already_paids = array_merge($already_paid, $total_calculated_installments);
            // dd($already_paid, $total_calculated_installments, $already_paids);

            $data = [
                'unpaid_installments_to_be_paid' => $installmentFullyPaidUnderAmount,
                'unpaid_installments_to_be_partialy_paid' => $installmentPartialyPaidUnderAmount,
                'total_calculated_installments' => $unpaid,
                'already_paid' => $already_paids,
                'paid' => $sales_plan->paidInstallments,
                'purpose' => str_replace(str_split('[]"'), '', json_encode($purpose)),
            ];
        } else {
            $data = [
                'unpaid_installments_to_be_paid' => null,
                'unpaid_installments_to_be_partialy_paid' => null,
                'total_calculated_installments' => null,
                'already_paid' => null,
                'paid' => null,
                'purpose' => null,
            ];
        }

        return $data;
    }
}

// updateStakeholderLoginContact
if (!function_exists('updateStakeholderLoginContact')) {
    function updateStakeholderLoginContact($stakeholder)
    {
        $valid = false;
        $localNumber = false;
        if ($stakeholder->stakeholder_as == 'i') {
            $contact = Str::slug($stakeholder->mobile_contact, '');
            $contact = Str::replace('+', '', $contact);
            $dialCode = json_decode($stakeholder->mobileContactCountryDetails);
            if ($dialCode && !Str::startsWith($contact, $dialCode->dialCode)) {
                $contact = $dialCode->dialCode . $contact;
            }
        } else {
            $contact = Str::slug($stakeholder->office_contact, '');
            $contact = Str::replace('+', '', $contact);
            $dialCode = json_decode($stakeholder->mobileContactCountryDetails);
            if ($dialCode && !Str::startsWith($contact, $dialCode->dialCode)) {
                $contact = $dialCode->dialCode . $contact;
            }
        }

        $lookupResponse = LifetimesmsFacade::networkLookup(['phone_number' => $contact]);
        $response = $lookupResponse['response'];
        if (isset($response['valid_numbers']) && $response['valid_numbers'] == 1) {
            $numberDetails = $response['messages'][0];
            $valid = true;
            if ($numberDetails['location']['country'] == 'Pakistan') {
                $localNumber = true;
            }
            $contact = $response['messages'][0]['number']['e164_format'];
        } elseif (isset($response['invalid_numbers']) && $response['invalid_numbers'] == 1) {
            $valid = false;
            $localNumber = false;
        }

        $stakeholder->login_contact = Str::startsWith($contact, '+') ? $contact : '+' . $contact;

        if ($stakeholder->remember_token == null) {
            $stakeholder->remember_token = Str::random(10);
        }
        $stakeholder->is_number_valid = $valid;
        $stakeholder->is_local_number = $localNumber;
        $stakeholder->save();
    }
}

// updateStakeholderLoginContact
if (!function_exists('phoneNumberFormat')) {
    function phoneNumberFormat($number)
    {
        // $valid = false;
        // $localNumber = false;
        // $number = Str::slug($number, '');
        // $lookupResponse = LifetimesmsFacade::networkLookup(['phone_number' => $number]);

        // $response = $lookupResponse['response'];
        // if (isset($response['valid_numbers']) && $response['valid_numbers'] == 1) {
        //     $numberDetails = $response['messages'][0];
        //     $valid = true;
        //     if ($numberDetails['location']['country'] == 'Pakistan') {
        //         $localNumber = true;
        //     }
        //     $number = $response['messages'][0]['number']['e164_format'];
        // } elseif (isset($response['invalid_numbers']) && $response['invalid_numbers'] == 1) {
        //     $valid = false;
        //     $localNumber = false;
        // }

        // $responseData = [
        //     'status' => $lookupResponse['status'],
        //     'valid' => $valid,
        //     'local' => $localNumber,
        //     'formated_number' => $number,
        // ];


        $responseData = [
            'status' => true,
            'valid' => true,
            'local' => true,
            'formated_number' => $number,
        ];

        return $responseData;
    }

    // Third level account balance management
    if (!function_exists('getThirdLevelAcountBalance')) {
        function getThirdLevelAcountBalance($code)
        {
            $todayDate = now();
            $yesterday = Carbon::yesterday();
            $tomorrow = Carbon::tomorrow();
            $lastMonthDays = Carbon::yesterday()->daysInMonth;
            $currentMonthDays = (int) date('j');

            $starting_code = $code;
            $ending_code = (int) $code + 1;
            $ending_code = $ending_code . '00000000';
            $nature = AccountHead::whereBetween('code', [$starting_code, $ending_code])->first()->account_type;

            $allAccounts = AccountHead::whereBetween('code', [$starting_code, $ending_code])->get();

            $balance = 0.0;
            $debit = 0.0;
            $credit = 0.0;
            $yesterdayDebit = 0.0;
            $yesterdayCredit = 0.0;
            $totalMonthBalance = 0.0;
            $yesterdayBalance = 0.0;
            $totalCurrentDebit = 0.0;
            $totalCurrentCredit = 0.0;

            foreach ($allAccounts as $account) {
                $accountLedgerCurrentMonth = AccountLedger::where('account_head_code', $account->code)
                    ->whereBetween(
                        'created_date',
                        [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
                    )->get();

                $accountLedgerLastMonth = AccountLedger::where('account_head_code', $account->code)->whereBetween(
                    'created_date',
                    [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]
                )->get();
                $accountLedgerYesterday = AccountLedger::where('account_head_code', $account->code)->whereDate('created_date', $yesterday)->get();

                // Yesterdays balance calculation

                $totalDebit = 0.0;
                $totalCredit = 0.0;

                // For Last month
                foreach ($accountLedgerLastMonth as $ledger) {
                    $totalCredit = (float) $totalCredit + (float) $ledger->credit;
                    $totalDebit = (float) $totalDebit + (float) $ledger->debit;
                }

                if ($totalDebit > 0) {
                    $yesterdayIn = (float) $totalDebit / (float) $lastMonthDays;
                } else {
                    $yesterdayIn = 0.0;
                }

                if ($totalCredit > 0) {
                    $yesterdayOut = (float) $totalCredit / (float) $lastMonthDays;
                } else {
                    $yesterdayOut = 0.0;
                }

                // For Current Month

                foreach ($accountLedgerCurrentMonth as $ledger) {
                    $totalCurrentCredit = (float) $totalCurrentCredit + (float) $ledger->credit;
                    $totalCurrentDebit = (float) $totalCurrentDebit + (float) $ledger->debit;
                    // $type = AccountHead::where('code', $ledger->account_head_code)->first()->account_type;
                }

                if ($totalDebit > 0) {
                    $currentIn = (float) $totalDebit;
                } else {
                    $currentIn = 0.0;
                }

                if ($totalCredit > 0) {
                    $currentOut = (float) $totalCredit;
                } else {
                    $currentOut = 0.0;
                }

                if ($nature == 'debit') {
                    foreach ($accountLedgerYesterday as $yesterdayAccounts) {

                        $ledger = AccountLedger::where('account_head_code', $yesterdayAccounts->account_head_code)->get();

                        foreach ($ledger as $ledger) {
                            $yesterdayBalance = $yesterdayBalance + ((float) $ledger->debit - (float) $ledger->credit);
                        }
                    }
                } else {
                    foreach ($accountLedgerYesterday as $yesterdayAccounts) {
                        $ledger = AccountLedger::where('account_head_code', $yesterdayAccounts->account_head_code)->get();
                        foreach ($ledger as $ledger) {
                            $yesterdayBalance = $yesterdayBalance + ((float) $ledger->credit - (float) $ledger->debit);
                        }
                    }
                }

                // Todays balance calculation

                $todaysBalance = 0.0;
                $accountLedgerToday = AccountLedger::where('account_head_code', $account->code)->whereDate('created_date', $todayDate)->get();

                foreach ($accountLedgerToday as $ledger) {
                    $type = AccountHead::where('code', $ledger->account_head_code)->first()->account_type;
                    if ($type == 'debit') {
                        $todaysBalance = (float) $ledger->debit - (float) $ledger->credit;
                    } else {
                        $todaysBalance = (float) $ledger->credit - (float) $ledger->debit;
                    }
                }
            }

            if ($nature == 'debit') {
                $totalMonthBalance = $totalMonthBalance + (float) $totalCurrentDebit - (float) $totalCurrentCredit;
            } else {
                $totalMonthBalance = $totalMonthBalance + (float) $totalCurrentCredit - (float) $totalCurrentDebit;
            }

            if ($nature == 'debit') {
                foreach ($allAccounts as $account) {

                    $ledger = AccountLedger::where('account_head_code', $account->code)->get();
                    foreach ($ledger as $ledger) {
                        if (isset($ledger->debit)) {
                            $debit = (float) $debit + (float) $ledger->debit;
                        }
                        if (isset($ledger->credit)) {
                            $credit = (float) $credit + (float) $ledger->credit;
                        }
                    }
                    $balance = (float) $debit - (float) $credit;
                }
            } else {
                foreach ($allAccounts as $account) {

                    $ledger = AccountLedger::where('account_head_code', $account->code)->get();
                    foreach ($ledger as $ledger) {
                        if (isset($ledger->debit)) {
                            $debit = (float) $debit + (float) $ledger->debit;
                        }
                        if (isset($ledger->credit)) {
                            $credit = (float) $credit + (float) $ledger->credit;
                        }
                    }
                    $balance = (float) $credit - (float) $debit;
                }
            }

            $yesterdayBalances = 0.0;
            $totalMonthBalances = 0.0;

            if ($yesterdayBalance > 0) {
                $yesterdayBalances = $totalMonthBalance;
                $totalMonthBalances = $yesterdayBalance;
            } else {
                $yesterdayBalances = $yesterdayBalance;
                $totalMonthBalances = $totalMonthBalance;
            }

            $data = [
                'balance' => $balance,
                'yesterday_in' => $yesterdayIn,
                'yesterday_out' => $yesterdayOut,
                'current_in' => $currentIn,
                'current_out' => $currentOut,
                'todays_balance' => $todaysBalance,
                'totalMonthBalance' => $totalMonthBalances,
                'yesterday_balance' => $yesterdayBalances,
            ];

            return $data;
        }
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($number, $precision = 2)
    {
        $exploded_number = explode('.', $number);
        $fomrated_number = number_format((float) $exploded_number[0]);
        if (isset($exploded_number[1])) {
            $afterPoint = substr($exploded_number[1], 0, 2);
            $number = (string) $fomrated_number . '.' . (string) $afterPoint;
        } else {
            $number = $fomrated_number;
        }

        return $number;
    }
}

if (!function_exists('generateProcurementMenu')) {
    function generateProcurementMenu($site_id, $id, $type)
    {
        $procurement = Procurement::find($id);
        $item_procurements = ItemProcurement::where('procurement_id', $procurement->id)->count();
        $item_procurements_supplier_assigend = ItemProcurement::where('procurement_id', $procurement->id)->where('winning_supplier_id', '!=', null)->count();

        if ($item_procurements == $item_procurements_supplier_assigend) {
            $status = 'Assigned';
        } else {
            $status = 'Not Assigned';
        }

        $procurementTypesMapping = [
            "PurchaseRequisition" => [
                'viewPath' => 'app.sites.procurement.procurement-requisition.actions',
                'key' => 'purchase_requisition',
            ],
            "RequestForQuotation" => [
                'viewPath' => 'app.sites.procurement.request-for-proposal.actions',
                'key' => 'requestForQuotation',
            ],
            "PurchaseOrder" => [
                'viewPath' => 'app.sites.procurement.purchase-order.actions',
                'key' => 'purchaseOrder',
            ],
            "GoodReceiptInspection" => [
                'viewPath' => 'app/sites/procurement/good-receipt-inspection/actions',
                'key' => 'goodReceiptInspection',
            ],
            "GoodReceivedNote" => [
                'viewPath' => 'app.sites.procurement.good-received-note.actions',
                'key' => 'goodReceivedNote',
            ],
            "PerformanceReport" => [
                'viewPath' => 'app.sites.procurement.performance-report.actions',
                'key' => 'performanceReport',
            ],
            "manual_stock_update" => [
                'viewPath' => 'app.sites.procurement.manual-stock-update.actions',
                'key' => 'manual_stock_update',
            ],
            "Invoice" => [
                'viewPath' => 'app.sites.procurement.invoice.actions',
                'key' => 'invoice',
            ],
        ];


        $selectedType = $procurementTypesMapping[$procurement->type] ?? null;
        if ($type == 'good_receipt_inspection') {
            $type = 'goods_receipt_inspection';
        }

        if ($selectedType) {
            $data = [
                'site_id' => $procurement->site_id,
                'id' => $procurement->id,
                $selectedType['key'] => $procurement,
                'isFullyApproved' => $procurement->isFullyApproved($type) ?? false,
                'canBypass' => $procurement->canBypass($type) ?? false,
                'isDisApproved' => $procurement->isDisApproved($type) ?? false,
                'status' => $status ?? null,
            ];
            return view($selectedType['viewPath'], $data);
        }
    }
}

if (!function_exists('isGRIRequired')) {
    function isGRIRequired($site_id)
    {
        $procurementConfiguration = ProcurementConfiguration::where('site_id', decryptParams($site_id))->first();
        return $procurementConfiguration && $procurementConfiguration->is_GRI_required;
    }
}
