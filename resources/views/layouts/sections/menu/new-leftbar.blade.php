<li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : null }}">
  <a class="menu-link" href="{{ route('dashboard') }}">
    {{-- <i class="menu-icon tf-icons ti ti-smart-home"></i> --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18" class="menu-icon" fill="non" viewBox="0 0 23 23">
      <defs>
        <style>
          .cls-1 {
            fill: #696270;
          }

          .cls-2 {
            fill: #fff;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M23,1.67A1.64,1.64,0,0,0,22.31.32a2.61,2.61,0,0,0-.7-.32H13.79c0,.08-.12.06-.17.08a1.67,1.67,0,0,0-1.17,1.59c0,3.36,0,6.72,0,10.08a1.66,1.66,0,0,0,1.65,1.67q3.63,0,7.26,0A1.65,1.65,0,0,0,23,11.75ZM22,11.9c0,.35-.07.41-.44.41H13.88c-.37,0-.42-.05-.42-.39V1.5c0-.34.06-.4.43-.4h7.66c.39,0,.46.06.46.42V11.9Z">
          </path>
          <path class="cls-1"
            d="M10.55,11.32A1.68,1.68,0,0,0,8.9,9.58H1.65A1.68,1.68,0,0,0,.08,10.72c0,.07,0,.15-.08.2V21.61s0,0,0,.06A1.67,1.67,0,0,0,1.78,23h7a2.36,2.36,0,0,0,.38,0,1.69,1.69,0,0,0,1.39-1.69v-10Zm-1,10.2c0,.36-.06.41-.44.41H1.44c-.38,0-.45-.06-.45-.43V11.07c0-.35.07-.41.42-.41H9.13c.36,0,.41.05.41.41Z">
          </path>
          <path class="cls-1"
            d="M9.36.07c-.06,0-.15,0-.2-.07H1.39A1.55,1.55,0,0,0,0,1.35v5c.08,0,.06.12.08.18A1.66,1.66,0,0,0,1.65,7.67H8.9A1.66,1.66,0,0,0,10.55,6c0-1.45,0-2.91,0-4.37A1.69,1.69,0,0,0,9.36.07Zm.07,6.09c0,.34-.06.4-.39.4H1.49c-.32,0-.38-.07-.38-.41V1.51c0-.32.08-.41.38-.41H9c.33,0,.4.07.4.42Z">
          </path>
          <path class="cls-1"
            d="M21.31,15.33H14.15A1.68,1.68,0,0,0,12.45,17q0,2.14,0,4.29A1.68,1.68,0,0,0,14.16,23H21.3A1.66,1.66,0,0,0,23,21.32V17A1.67,1.67,0,0,0,21.31,15.33Zm.7,6.25c0,.39-.08.47-.45.47H13.9c-.39,0-.44-.07-.44-.49v-4.8c0-.41,0-.46.43-.46h7.67c.39,0,.45.06.45.48Z">
          </path>
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate">{{ __('Dashboard') }}</span>
  </a>
</li>

@if (Auth::user()->can('permissions.index') ||
Auth::user()->can('roles.index') ||
Auth::user()->can('sites.configurations.configView'))
<li class="menu-header">

  <span class="menu-header-text">{{ __('Administration') }}</span>

</li>
@endif

@if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index'))
<li class="menu-item {{ request()->routeIs('roles.index') ||
        request()->routeIs('roles.create') ||
        request()->routeIs('permissions.index')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle " href="javascript:void(0)">
    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 21 18" fill="none" class="menu-icon">
      <g clip-path="url(#clip0_60_44)">
        <path d="M14.3 2.70005L16.2 4.60005L20 0.800049" stroke="#686371" stroke-linecap="round"
          stroke-linejoin="round" />
        <path
          d="M10.3 0C10.1 0.6 10.2 0.5 10.2 1.2L1.1 1.1V17H17V7.8C17.7 7.8 17.4 7.9 18.1 7.7V17C18.1 17.3 18 17.5 17.8 17.7C17.6 17.9 17.3 18 17 18H1C0.7 18 0.5 17.9 0.3 17.7C0.1 17.5 0 17.3 0 17V1C0 0.7 0.1 0.5 0.3 0.3C0.5 0.1 0.7 0 1 0H10.3Z"
          fill="#696370" />
        <path
          d="M14 12.9C13.8 11.7 13.1 10.8 12 10.4C13.4 8.59995 13 6.29995 11.7 5.09995C10.3 3.79995 8.20001 3.69995 6.70001 4.79995C5.90001 5.29995 5.40001 6.09995 5.20001 7.09995C4.90001 8.29995 5.20001 9.39995 6.00001 10.4H5.90001C4.80001 10.9 4.20001 11.7 4.00001 12.8C3.90001 13.5 4.00001 14.2 4.00001 14.8C4.00001 15.2 4.30001 15.6 4.80001 15.6C5.20001 15.6 5.30001 15.1 5.30001 14.7C5.30001 14.2 5.30001 13.7 5.30001 13.3C5.30001 12.3 6.30001 11.5 7.30001 11.5C8.50001 11.5 9.60001 11.5 10.8 11.5C11.8 11.5 12.8 12.5 12.8 13.5C12.8 14 12.8 14.4 12.8 14.9C12.8 15.3 12.8 15.7 13.2 15.7C13.6 15.7 14 15.4 14 15.1C14.1 14.3 14.1 13.6 14 12.9ZM9.00001 10.8C7.40001 10.8 6.00001 9.39995 6.10001 7.79995C6.10001 6.19995 7.50001 4.89995 9.10001 4.89995C10.7 4.89995 12.1 6.29995 12 7.89995C11.9 9.49995 10.6 10.9 9.00001 10.8Z"
          fill="#676270" />
      </g>
      <defs>
        <clipPath id="clip0_60_44">
          <rect width="20.6" height="18" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate">{{ __('Roles And Permissions') }}</span>
  </a>
  <ul class="menu-sub">
    @can('roles.index')
    <li class="menu-item {{ request()->routeIs('roles.index') || request()->routeIs('roles.create') || request()->routeIs('roles.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('roles.index') }}">
        <span class="menu-title text-truncate">{{ __('Roles') }}</span>
      </a>
    </li>
    @endcan

    @can('permissions.index')
    <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : null }}">
      <a class="menu-link" href="{{ route('permissions.index') }}">

        <span class="menu-title text-truncate">{{ __('Permissions') }}</span>
      </a>
    </li>
    @endcan
  </ul>
</li>
@endif

@canany(['sites.stakeholders.importStakeholders', 'sites.stakeholders.kins.importStakeholders',
'sites.stakeholders.contacts.importStakeholders', 'sites.floors.importFloors', 'sites.types.importTypes',
'sites.additional-costs.importAdcosts', 'sites.floors.unitsImport.importUnits',
'sites.floors.SalesPlanImport.importSalesPlan', 'sites.floors.spadcostsImport.importspadcosts',
'sites.floors.spInstallmentsImport.ImportInstallments', 'sites.banks.importBanks', 'sites.receipts.importReceipts',
'sites.file-managements.importFiles', 'sites.file-managements.importFilesContacts',
'sites.settings.manual-entries.importManualEntries', 'sites.crm.import.opportunity.import',
'sites.crm.import.stage.import', 'sites.settings.import.images.index',
'sites.procurment.manual-stock-update.import-stock-update'])
<li class="menu-item {{ request()->routeIs('sites.import-files') ||
        request()->routeIs('sites.stakeholders.importStakeholders') ||
        request()->routeIs('sites.stakeholders.kins.importStakeholders') ||
        request()->routeIs('sites.stakeholders.contacts.importStakeholders') ||
        request()->routeIs('sites.floors.importFloors') ||
        request()->routeIs('sites.types.importTypes') ||
        request()->routeIs('sites.additional-costs.importAdcosts') ||
        request()->routeIs('sites.floors.unitsImport.importUnits') ||
        request()->routeIs('sites.floors.SalesPlanImport.importSalesPlan') ||
        request()->routeIs('sites.floors.spadcostsImport.importspadcosts') ||
        request()->routeIs('sites.floors.spInstallmentsImport.ImportInstallments') ||
        request()->routeIs('sites.banks.importBanks') ||
        request()->routeIs('sites.file-managements.importFiles') ||
        request()->routeIs('sites.file-managements.importFilesContacts') ||
        request()->routeIs('sites.settings.journal-vouchers.importJournalVoucher') ||
        request()->routeIs('sites.receipts.importReceipts') ||
        request()->routeIs('sites.settings.import.images.index') ||
        request()->routeIs('sites.settings.import.images.create') ||
        request()->routeIs('sites.crm.import.stage.import') ||
        request()->routeIs('sites.sales_plan_application_form.import.Application-Form') ||
        request()->routeIs('sites.procurment.manual-stock-update.import-stock-update')
            ? 'active'
            : null }}">
  <a class="menu-link" href="{{ route('sites.import-files', ['site_id' => encryptParams($site_id)]) }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" class="menu-icon">
      <g clip-path="url(#clip0_59_31)">
        <path
          d="M7.5999 8.19995C8.7999 8.19995 10.0999 8.19995 11.2999 8.19995C11.7999 8.19995 12.1999 8.39995 12.2999 8.89995C12.2999 9.39995 11.9999 9.79995 11.3999 9.79995C8.8999 9.79995 6.3999 9.79995 3.8999 9.79995C3.2999 9.79995 2.8999 9.49995 2.8999 8.99995C2.8999 8.49995 3.1999 8.19995 3.8999 8.19995C5.0999 8.19995 6.2999 8.19995 7.5999 8.19995Z"
          fill="#6A6371" />
        <path
          d="M5.8999 11.3C6.6999 11.3 7.3999 11.3 8.1999 11.3C8.6999 11.3 8.9999 11.5 9.0999 12.1C9.0999 12.6 8.7999 12.9 8.2999 12.9C6.7999 12.9 5.1999 12.9 3.6999 12.9C3.1999 12.9 2.8999 12.6 2.8999 12.1C2.8999 11.6 3.2999 11.3 3.7999 11.3C4.3999 11.3 5.1999 11.3 5.8999 11.3Z"
          fill="#6A6371" />
        <path
          d="M5.9999 16C5.2999 16 4.5999 16 3.8999 16C3.1999 16 2.8999 15.7 2.8999 15.2C2.8999 14.7 3.1999 14.4 3.8999 14.4C5.2999 14.4 6.7999 14.4 8.1999 14.4C8.6999 14.4 9.0999 14.6 9.0999 15.1C9.0999 15.6 8.7999 15.9 8.1999 15.9C7.3999 16 6.6999 16 5.9999 16Z"
          fill="#6A6371" />
        <path
          d="M15.6 13.6C16.8 13.6 17.9 13.6 18.9 13.6C19.1 13.6 19.3 13.6 19.5 13.6C20 13.7 20.3 13.9 20.3 14.5C20.3 15 20 15.2 19.5 15.2C18.4 15.2 17.3 15.2 16.3 15.2C16.1 15.2 15.9 15.2 15.6 15.2C15.9 15.6 16.1 15.9 16.3 16.3C16.6 16.7 16.5 17.1 16.1 17.4C15.7 17.7 15.3 17.6 15 17.2C14.5 16.4 14 15.7 13.4 14.9C13.2 14.6 13.2 14.3 13.4 14C13.9 13.2 14.4 12.4 15 11.7C15.3 11.3 15.7 11.2 16.1 11.5C16.5 11.8 16.6 12.2 16.3 12.6C16.1 12.9 15.9 13.2 15.6 13.6Z"
          fill="#6A6371" />
        <path
          d="M18.7 22.5C18.7 22.1 18.5 21.9 18 21.9C17.5 21.9 17.5 22.3 17.5 23C17.5 23.4 17.2 23.8 16.8 23.8C11.9 23.7 6.9 23.8 2.1 23.8C1.7 23.8 1.2 23.2 1.2 22.8C1.2 15.8 1.2 8.8 1.1 1.9C1.1 1.6 1.4 1.1 1.8 1.1C5 1.1 8.2 1 11.3 1C11.7 1 11.7 1.7 11.7 2C11.7 3 11.7 4 11.7 5.1C11.7 6.1 11.9 6.2 12.8 6.2C13.9 6.2 15 6.2 16.2 6.2C16.8 6.2 17.7 6 17.6 6.9C17.5 7.4 17.7 7.7 18.2 7.7C18.7 7.7 18.8 7.4 18.8 6.9C18.8 6.5 18.8 6.1 18.8 5.7C18.8 5.3 18.7 5 18.4 4.7C16.7 3.2 15 1.8 13.3 0.3C13 0.1 12.7 0 12.3 0C8.5 0 4.8 0 1 0C0.6 0 0.2 0.1 0 0.5C0 8.5 0 16.5 0 24.5C0.1 24.8 0.2 24.9 0.5 25C6.4 25 12.3 25 18.3 25C18.5 24.8 18.8 24.7 18.8 24.4C18.8 23.8 18.8 23.1 18.7 22.5ZM12.9 1.9C14.2 3 15.9 4.1 17.3 5.2C16 5.2 14.5 5.2 13.4 5.2C13 5.2 12.8 5.1 12.8 4.6C12.9 3.9 12.9 3 12.9 1.9Z"
          fill="#6A6371" />
        <path
          d="M16.9001 8.19995C13.5001 8.19995 10.6001 10.9 10.6001 14.3C10.6001 17.9 13.3001 20.7 16.8001 20.7C20.2001 20.7 23.1001 17.9 23.1001 14.5C23.1001 11 20.4001 8.19995 16.9001 8.19995ZM16.8001 19.4C14.0001 19.4 11.9001 17.2 11.9001 14.4C11.9001 11.6 14.1001 9.39995 16.9001 9.39995C19.6001 9.39995 21.9001 11.6 21.9001 14.4C21.8001 17.2 19.6001 19.4 16.8001 19.4Z"
          fill="#6A6371" />
      </g>
      <defs>
        <clipPath id="clip0_59_31">
          <rect width="23.1" height="25" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate" data-i18n="Import Files">Import Files</span>
  </a>
</li>
@endcanany

@can('sites.communication-channel-notifications.index')
<li class="menu-item {{ request()->routeIs('sites.communication-channel-notifications.index') ? 'active' : null }}">
  <a class="menu-link"
    href="{{ route('sites.communication-channel-notifications.index', ['site_id' => encryptParams($site_id)]) }}">
    {{-- <i data-feather='settings'></i> --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none" class="menu-icon">
      <g clip-path="url(#clip0_57_25)">
        <path
          d="M8.8 21.2999C7.6 21.2999 6.5 20.8999 5.6 19.8999C5.3 19.5999 5.3 19.1999 5.6 18.9999C5.9 18.6999 6.3 18.6999 6.6 18.9999C7 19.4999 7.6 19.7999 8.3 19.8999C9.4 19.9999 10.3 19.7999 11 18.9999C11.3 18.6999 11.7 18.6999 11.9 18.8999C12.2 19.0999 12.2 19.4999 11.9 19.8999C11.2 20.6999 10.3 21.0999 9.2 21.2999C9.1 21.2999 9 21.2999 8.8 21.2999Z"
          fill="#6A6371" />
        <path
          d="M17.3999 14.9999C17.1999 14.6999 17.0999 14.4999 16.8999 14.1999C16.3999 13.3999 16.0999 12.4999 16.0999 11.4999C16.0999 10.1999 16.0999 8.79995 16.0999 7.49995C16.0999 6.99995 16.0999 6.59995 15.9999 6.09995C15.4999 2.89995 12.7999 0.399946 9.49994 0.0999459C7.29994 -0.200054 5.29994 0.499946 3.69994 2.09995C2.39994 3.39995 1.69994 4.99995 1.59994 6.79995C1.49994 8.19995 1.59994 9.69995 1.59994 11.0999C1.59994 11.8999 1.49994 12.6999 1.19994 13.4999C0.999935 13.9999 0.699935 14.4999 0.399935 14.9999C-6.48201e-05 15.3999 -0.100065 15.7999 -6.4835e-05 16.2999C0.199935 17.1999 0.899935 17.7999 1.89994 17.7999C4.19994 17.7999 6.49994 17.7999 8.79994 17.7999C11.0999 17.7999 13.3999 17.7999 15.7999 17.7999C17.1999 17.7999 18.0999 16.2999 17.3999 14.9999ZM15.6999 16.4999C13.3999 16.4999 11.0999 16.4999 8.79994 16.4999C6.49994 16.4999 4.29994 16.4999 1.99994 16.4999C1.79994 16.4999 1.59994 16.4999 1.49994 16.3999C1.29994 16.1999 1.19994 15.8999 1.39994 15.6999C1.69994 15.1999 1.99994 14.6999 2.29994 14.0999C2.69994 13.1999 2.89994 12.1999 2.89994 11.1999C2.89994 9.89995 2.89994 8.49995 2.89994 7.19995C2.99994 5.19995 3.89994 3.59995 5.59994 2.49995C9.09994 0.199946 13.8999 2.09995 14.6999 6.29995C14.7999 6.79995 14.7999 7.19995 14.7999 7.69995C14.7999 9.09995 14.7999 10.4999 14.7999 11.8999C14.7999 12.9999 15.1999 14.0999 15.6999 14.9999C15.8999 15.2999 15.9999 15.4999 16.1999 15.7999C16.4999 16.0999 16.2999 16.4999 15.6999 16.4999Z"
          fill="#6A6371" />
      </g>
      <defs>
        <clipPath id="clip0_57_25">
          <rect width="17.6" height="21.3" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate">Communications
    </span>
  </a>
</li>
@endcan

@can('sites.approvals.documents.index')
<li class="menu-item {{ request()->routeIs('sites.approvals.documents.index') ? 'active' : null }}">
  <a class="menu-link" href="{{ route('sites.approvals.documents.index', ['site_id' => encryptParams($site_id)]) }}">

    <svg width="5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.82 32.82" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6f6372;
            fill-rule: evenodd;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1" d="M3.63,29.32l11.91-9.74a2.31,2.31,0,1,0-2.3-2.3L3.5,29.18l-.06.2Z" />
          <path class="cls-1"
            d="M32.48,9.55,23.27.34h0a1.15,1.15,0,0,0-1.63,0L17.25,4.72,9.62,6.63A3.44,3.44,0,0,0,7.15,9L0,32.82l23.83-7.15a3.46,3.46,0,0,0,2.36-2.47l1.91-7.64,4.38-4.38h0A1.15,1.15,0,0,0,32.48,9.55ZM24.66,23a1.25,1.25,0,0,1-.85.89l-22,7.2L9,9a1.22,1.22,0,0,1,.88-.85l7.87-2h0l8.91,8.92Zm2.95-9.47L19.38,5.27,22.44,2.2l8.24,8.24Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate">Approvals
    </span>
  </a>
</li>
@endcan

{{-- Setting Menu --}}
@canany([
'sites.configurations.configView',
'sites.settings.custom-fields.index',
'sites.settings.activity-logs.index',
'sites.settings.accounts.first-level.index',
'sites.settings.accounts.second-level.index',
'sites.settings.accounts.third-level.index',
'sites.settings.accounts.fourth-level.index',
'sites.settings.accounts.fifth-level.index',
'sites.settings.import',
'sites.stakeholders.importStakeholders',
'sites.stakeholders.kins.importStakeholders',
'sites.floors.importFloors',
'sites.types.importTypes',
'sites.additional-costs.importAdcosts',
'sites.floors.unitsImport.importUnits',
'sites.banks.importBanks',
'sites.settings.import.images.index',
'sites.settings.countries.index',
'sites.settings.states.index',
'sites.settings.cities.index',
'sites.floors.SalesPlanImport.importSalesPlan',
'sites.floors.spadcostsImport.importspadcosts',
'sites.floors.spInstallmentsImport.ImportInstallments',
'sites.trash.sales-plan',
'sites.file-managements.importFiles',
'sites.banks.index',
'sites.lead-sources.index',
'sites.types.index',
'sites.trash.crm-opportunity',
'sites.additional-costs.index',
'sites.settings.accounts.account-action.index',
'sites.trash.receipts',
'sites.trash.application-form',
'sites.trash.file',
'sites.trash.ledgers',
'sites.trash.payment-voucher',
'sites.settings.social-leads.index',
'sites.settings.accounts.account-action.edit',
'sites.settings.accounts.account-action.create',
'sites.settings.accounts.second-level.create',
'sites.settings.countries.create',
'sites.settings.countries.edit',
'sites.settings.states.create',
'sites.settings.states.edit',
'sites.settings.cities.create',
'sites.settings.cities.edit',
'sites.types.create',
'sites.types.edit',
'sites.banks.create',
'sites.banks.edit',
'sites.accounts.accounting-period.edit',
'sites.accounts.accounting-period.preview',
'sites.accounts.accounting-period.create',
'sites.accounts.accounting-period.index',
'sites.year-closing.index',
])
<li class="menu-item {{ request()->routeIs('sites.configurations.configView') ||
        request()->routeIs('sites.settings.custom-fields.index') ||
        request()->routeIs('sites.settings.activity-logs.index') ||
        request()->routeIs('sites.settings.accounts.first-level.index') ||
        request()->routeIs('sites.settings.accounts.second-level.index') ||
        request()->routeIs('sites.settings.accounts.third-level.index') ||
        request()->routeIs('sites.settings.accounts.fourth-level.index') ||
        request()->routeIs('sites.settings.accounts.fifth-level.index') ||
        request()->routeIs('sites.settings.import') ||
        request()->routeIs('sites.stakeholders.importStakeholders') ||
        request()->routeIs('sites.stakeholders.kins.importStakeholder') ||
        request()->routeIs('sites.floors.importFloors') ||
        request()->routeIs('sites.types.importTypes') ||
        request()->routeIs('sites.additional-costs.importAdcosts') ||
        request()->routeIs('sites.floors.unitsImport.importUnits') ||
        request()->routeIs('sites.banks.importBanks') ||
        request()->routeIs('sites.settings.import.images.index') ||
        request()->routeIs('sites.settings.countries.index') ||
        request()->routeIs('sites.settings.states.index') ||
        request()->routeIs('sites.settings.cities.index') ||
        request()->routeIs('sites.floors.SalesPlanImport.importSalesPlan') ||
        request()->routeIs('sites.floors.spadcostsImport.importspadcosts') ||
        request()->routeIs('sites.floors.spInstallmentsImport.ImportInstallments') ||
        request()->routeIs('sites.trash.sales-plan') ||
        request()->routeIs('sites.file-managements.importFiles') ||
        request()->routeIs('sites.banks.index') ||
        request()->routeIs('sites.lead-sources.index') ||
        request()->routeIs('sites.types.index') ||
        request()->routeIs('sites.additional-costs.index') ||
        request()->routeIs('sites.settings.accounts.account-action.index') ||
        request()->routeIs('sites.trash.receipts') ||
        request()->routeIs('sites.trash.application-form') ||
        request()->routeIs('sites.trash.file') ||
        request()->routeIs('sites.trash.ledgers') ||
        request()->routeIs('sites.trash.payment-voucher') ||
        request()->routeIs('sites.settings.social-leads.*') ||
        request()->routeIs('sites.additional-costs.index', ['site_id' => encryptParams($site_id)]) ||
        request()->routeIs('sites.additional-costs.create') ||
        request()->routeIs('sites.additional-costs.edit') ||
        request()->routeIs('sites.lead-sources.index', ['site_id' => encryptParams($site_id)]) ||
        request()->routeIs('sites.lead-sources.create') ||
        request()->routeIs('sites.lead-sources.edit') ||
        request()->routeIs('sites.settings.custom-fields.index') ||
        request()->routeIs('sites.settings.custom-fields.create') ||
        request()->routeIs('sites.settings.custom-fields.edit') ||
        request()->routeIs('sites.settings.accounts.account-action.edit') ||
        request()->routeIs('sites.settings.accounts.account-action.create') ||
        request()->routeIs('sites.settings.accounts.second-level.index') ||
        request()->routeIs('sites.settings.accounts.second-level.create') ||
        request()->routeIs('sites.settings.countries.create') ||
        request()->routeIs('sites.settings.countries.edit') ||
        request()->routeIs('sites.settings.states.create') ||
        request()->routeIs('sites.settings.states.edit') ||
        request()->routeIs('sites.settings.cities.create') ||
        request()->routeIs('sites.settings.cities.edit') ||
        request()->routeIs('sites.types.create') ||
        request()->routeIs('sites.types.edit') ||
        request()->routeIs('sites.banks.create') ||
        request()->routeIs('sites.banks.edit') ||
        request()->routeIs('sites.accounts.accounting-period.edit') ||
        request()->routeIs('sites.accounts.accounting-period.preview') ||
        request()->routeIs('sites.accounts.accounting-period.create') ||
        request()->routeIs('sites.accounts.accounting-period.index') ||
        request()->routeIs('sites.year-closing.index') ||
        request()->routeIs('sites.trash.crm-opportunity') ||
        request()->routeIs('sites.trash.units')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="javascript:void(0)">

    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" class="menu-icon">
      <g clip-path="url(#clip0_66_49)">
        <path
          d="M22 9.7C21.9 9.2 21.5 8.8 21 8.7C20.5 8.6 20.1 8.5 19.6 8.4C19.4 8.4 19.3 8.3 19.3 8.2C19.2 7.8 19 7.4 18.8 7.1C18.7 7 18.7 6.9 18.8 6.8C19.1 6.4 19.3 6.1 19.6 5.7C20 5.1 20 4.4 19.4 3.9C19 3.4 18.6 3 18.2 2.6C17.6 2 16.9 2 16.3 2.4C15.9 2.6 15.6 2.9 15.3 3.1C15.2 3.2 15.1 3.2 15 3.1C14.6 2.9 14.2 2.7 13.8 2.6C13.6 2.6 13.6 2.5 13.6 2.3C13.5 1.9 13.5 1.4 13.4 1C13.1 0.5 12.6 0 11.9 0C11.2 0 10.6 0 9.9 0C9.3 0 8.8 0.4 8.7 1C8.6 1.5 8.5 2 8.4 2.4C8.4 2.6 8.3 2.7 8.1 2.7C7.8 2.9 7.4 3.1 7 3.3C6.9 3.4 6.8 3.3 6.7 3.3C6.4 3 6.1 2.7 5.7 2.5C5.1 2 4.4 2.1 3.8 2.6C3.4 3 3 3.4 2.6 3.8C2 4.4 1.9 5.1 2.4 5.8C2.7 6.2 2.9 6.5 3.2 6.9C3.3 7 3.3 7.1 3.2 7.1C3 7.5 2.8 7.9 2.7 8.3C2.7 8.4 2.6 8.5 2.5 8.5C2 8.6 1.6 8.6 1.1 8.7C0.5 8.9 0 9.4 0 10.1C0 10.8 0 11.4 0 12.1C0 12.7 0.4 13.2 1 13.4C1.5 13.5 2 13.6 2.6 13.7C2.7 13.7 2.8 13.8 2.8 13.9C2.9 14.2 3 14.6 3.3 15C3.4 15.1 3.4 15.2 3.3 15.3C3 15.6 2.8 16 2.5 16.3C2 17 2.1 17.6 2.6 18.2C3 18.6 3.5 19 3.9 19.4C4.4 20 5.1 20 5.8 19.6C6.2 19.3 6.5 19.1 6.9 18.8C7 18.7 7.1 18.7 7.2 18.8C7.6 19 7.9 19.1 8.3 19.3C8.5 19.3 8.5 19.4 8.5 19.6C8.6 20 8.6 20.4 8.7 20.7C8.8 21.2 8.9 21.6 9.4 21.8C9.5 21.9 9.7 21.9 9.8 22C10.6 22 11.4 22 12.2 22C12.4 22 12.5 22 12.7 21.8C13 21.6 13.3 21.3 13.4 20.9C13.5 20.5 13.5 20 13.6 19.6C13.6 19.4 13.7 19.3 13.9 19.3C14.2 19.2 14.5 19.1 14.9 18.9C15.1 18.8 15.2 18.8 15.4 18.9C15.7 19.1 16 19.4 16.4 19.6C17 20 17.6 20 18.2 19.6C18.7 19.2 19.2 18.6 19.7 18.1C20.2 17.5 20.2 16.8 19.7 16.2C19.5 15.9 19.2 15.5 19 15.2C18.9 15.1 18.9 15 19 14.8C19.2 14.5 19.3 14.1 19.4 13.8C19.4 13.6 19.5 13.6 19.7 13.5C20.1 13.4 20.5 13.4 20.9 13.3C21.5 13.2 22 12.8 22.1 12.2C22 11.4 22 10.6 22 9.7C22 9.8 22 9.8 22 9.7ZM20.8 10.2C20.8 10.5 20.8 10.7 20.8 11C20.8 11.3 20.8 11.6 20.8 11.8C20.8 12 20.7 12.1 20.6 12.1C20.1 12.2 19.5 12.3 19 12.4C18.6 12.5 18.4 12.6 18.3 13C18.1 13.6 17.9 14.2 17.6 14.7C17.4 15 17.4 15.3 17.7 15.6C18 16.1 18.4 16.5 18.7 17C18.8 17.1 18.8 17.2 18.7 17.3C18.3 17.7 17.9 18.1 17.5 18.5C17.4 18.6 17.3 18.6 17.2 18.5C16.7 18.2 16.3 17.8 15.8 17.5C15.5 17.3 15.3 17.3 15 17.5C14.4 17.8 13.9 18.1 13.2 18.2C12.9 18.3 12.7 18.5 12.6 18.8C12.5 19.3 12.4 19.9 12.3 20.4C12.3 20.6 12.2 20.7 12 20.7C11.4 20.7 10.9 20.7 10.3 20.7C10.1 20.7 10.1 20.7 10 20.5C9.9 20 9.8 19.4 9.7 18.9C9.6 18.5 9.5 18.3 9.1 18.2C8.5 18 7.9 17.8 7.4 17.5C7.1 17.3 6.8 17.3 6.5 17.6C6 17.9 5.6 18.3 5.1 18.6C4.9 18.7 4.9 18.7 4.7 18.6C4.3 18.2 3.9 17.8 3.5 17.4C3.4 17.3 3.3 17.2 3.5 17C3.8 16.6 4.1 16.1 4.5 15.6C4.7 15.3 4.7 15 4.6 14.7C4.2 14.2 4 13.6 3.8 13C3.7 12.7 3.5 12.5 3.2 12.5C2.6 12.4 2.1 12.3 1.5 12.2C1.3 12.2 1.2 12.1 1.2 11.9C1.2 11.3 1.2 10.8 1.2 10.2C1.2 10 1.2 10 1.4 10C2 9.9 2.6 9.7 3.1 9.7C3.5 9.6 3.7 9.5 3.8 9.1C4 8.5 4.2 7.9 4.5 7.3C4.7 7 4.7 6.8 4.5 6.5C4.1 6 3.8 5.5 3.4 5.1C3.3 5 3.3 4.9 3.4 4.8C3.8 4.4 4.2 4 4.6 3.6C4.7 3.5 4.8 3.5 4.9 3.6C5.4 3.9 5.8 4.2 6.3 4.6C6.7 4.7 7 4.7 7.3 4.5C7.8 4.2 8.4 4 9 3.8C9.4 3.7 9.5 3.5 9.6 3.1C9.7 2.6 9.8 2 9.9 1.4C9.9 1.3 10 1.2 10.1 1.2C10.7 1.2 11.2 1.2 11.8 1.2C12 1.2 12 1.3 12.1 1.4C12.2 2 12.3 2.6 12.4 3.1C12.4 3.4 12.6 3.6 12.9 3.7C13.6 3.9 14.2 4.1 14.8 4.5C15.1 4.7 15.3 4.6 15.6 4.4C16.1 4.1 16.5 3.7 17 3.4C17.1 3.3 17.2 3.3 17.4 3.4C17.8 3.8 18.2 4.2 18.6 4.6C18.7 4.7 18.7 4.8 18.6 4.9C18.3 5.4 17.9 5.8 17.6 6.3C17.4 6.6 17.4 6.9 17.6 7.2C17.8 7.8 18 8.4 18.2 9C18.3 9.4 18.5 9.5 18.9 9.6C19.4 9.7 20 9.8 20.5 9.9C20.7 9.9 20.8 10 20.8 10.2Z"
          fill="#6B6371" />
        <path
          d="M11.0999 6.2C8.59991 6.1 6.39991 8.1 6.29991 10.7C6.19991 13.2 8.09991 15.6 10.9999 15.7C13.3999 15.8 15.6999 13.9 15.7999 11C15.7999 8.7 13.8999 6.3 11.0999 6.2ZM10.9999 14.5C9.09991 14.5 7.49991 13 7.49991 11C7.49991 9.1 8.99991 7.5 10.9999 7.5C12.8999 7.5 14.4999 9.1 14.4999 11C14.4999 12.9 12.8999 14.5 10.9999 14.5Z"
          fill="#6B6371" />
      </g>
      <defs>
        <clipPath id="clip0_66_49">
          <rect width="22" height="22" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate" data-i18n="Settings">Settings</span>
  </a>
  <ul class="menu-sub">
    @can('sites.configurations.configView')
    <li class="menu-item {{ request()->routeIs('sites.configurations.configView', ['id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.accounts.accounting-period.edit') ||
                    request()->routeIs('sites.accounts.accounting-period.preview') ||
                    request()->routeIs('sites.accounts.accounting-period.create') ||
                    request()->routeIs('sites.accounts.accounting-period.index')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.configurations.configView', ['id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Site Configurations</span>
      </a>
    </li>
    @endcan
    @can('sites.year-closing.index')
    <li class="menu-item {{ request()->routeIs('sites.year-closing.index') ? 'active' : null }}">
      <a class="menu-link" href="{{ route('sites.year-closing.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate">Year Closing</span>
      </a>
    </li>
    @endcan
    @can('sites.types.index')
    <li class="menu-item {{ request()->routeIs('sites.types.index') ||
                    request()->routeIs('sites.types.create') ||
                    request()->routeIs('sites.types.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.types.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Types</span>
      </a>
    </li>
    @endcan

    {{-- Additional Costs Menu --}}
    @can('sites.additional-costs.index')
    <li class="menu-item {{ request()->routeIs('sites.additional-costs.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.additional-costs.create') ||
                    request()->routeIs('sites.additional-costs.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.additional-costs.index', ['site_id' => encryptParams($site_id)]) }}">

        {{-- <img class="menu-icon" src="{{ asset('app-assets') }}/sitebar-icon/add-costs.svg" /> --}}
        <span class="menu-title text-truncate">Additional Costs</span>
      </a>
    </li>
    @endcan

    {{-- Lead Sources Menu --}}
    @can('sites.lead-sources.index')
    <li class="menu-item {{ request()->routeIs('sites.lead-sources.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.lead-sources.create') ||
                    request()->routeIs('sites.lead-sources.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.lead-sources.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Lead Sources</span>
      </a>
    </li>
    @endcan

    {{-- @can('sites.settings.activity-logs.index')
    <li class="menu-item {{ request()->routeIs('sites.settings.activity-logs.index') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.settings.activity-logs.index', ['site_id' => encryptParams($site_id)]) }}">


        <span class="menu-title text-truncate" data-i18n="Activity Logs">Activity Logs</span>
      </a>
    </li>
    @endcan --}}
    @can('sites.settings.custom-fields.index')
    <li class="menu-item {{ request()->routeIs('sites.settings.custom-fields.index') ||
                    request()->routeIs('sites.settings.custom-fields.create') ||
                    request()->routeIs('sites.settings.custom-fields.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.settings.custom-fields.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Custom Fields">Custom Fields</span>
      </a>
    </li>
    @endcan

    <li class="menu-item {{ request()->routeIs('sites.settings.accounts.account-action.index') ||
                request()->routeIs('sites.settings.accounts.account-action.edit') ||
                request()->routeIs('sites.banks.index') ||
                request()->routeIs('sites.banks.edit') ||
                request()->routeIs('sites.settings.accounts.first-level.index') ||
                request()->routeIs('sites.settings.accounts.first-level.create') ||
                request()->routeIs('sites.settings.accounts.second-level.index') ||
                request()->routeIs('sites.settings.accounts.second-level.create') ||
                request()->routeIs('sites.settings.accounts.third-level.index') ||
                request()->routeIs('sites.settings.accounts.third-level.create') ||
                request()->routeIs('sites.settings.accounts.fourth-level.index') ||
                request()->routeIs('sites.settings.accounts.fourth-level.create') ||
                request()->routeIs('sites.settings.accounts.fifth-level.index') ||
                request()->routeIs('sites.settings.accounts.fifth-level.create') ||
                request()->routeIs('sites.settings.accounts.account-action.index') ||
                request()->routeIs('sites.settings.accounts.account-action.edit') ||
                request()->routeIs('sites.settings.accounts.account-action.create')
                    ? 'active open'
                    : null }}">
      <a class="menu-link menu-toggle" href="javascript:void(0)">

        <span class="menu-title text-truncate">
          Accounts</span>
      </a>
      <ul class="menu-sub">
        @can('sites.settings.accounts.account-action.index')
        <li
          class="menu-item {{ request()->routeIs('sites.settings.accounts.account-action.index') || request()->routeIs('sites.settings.accounts.account-action.edit') || request()->routeIs('sites.settings.accounts.account-action.create') ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.accounts.account-action.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Account Action</span>
          </a>
        </li>
        @endcan
        @can('sites.banks.index')
        <li class="menu-item {{ request()->routeIs('sites.banks.index') ||
                            request()->routeIs('sites.banks.create') ||
                            request()->routeIs('sites.banks.edit')
                                ? 'active'
                                : null }}">
          <a class="menu-link" href="{{ route('sites.banks.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Banks</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.accounts.first-level.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.accounts.first-level.index') ||
                            request()->routeIs('sites.settings.accounts.first-level.create')
                                ? 'active'
                                : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.accounts.first-level.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">1st Level</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.accounts.second-level.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.accounts.second-level.index') ||
                            request()->routeIs('sites.settings.accounts.second-level.create')
                                ? 'active'
                                : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.accounts.second-level.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">2nd Level</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.accounts.third-level.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.accounts.third-level.index') ||
                            request()->routeIs('sites.settings.accounts.third-level.create')
                                ? 'active'
                                : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.accounts.third-level.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">3rd Level</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.accounts.fourth-level.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.accounts.fourth-level.index') ||
                            request()->routeIs('sites.settings.accounts.fourth-level.create')
                                ? 'active'
                                : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.accounts.fourth-level.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">4th Level</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.accounts.fifth-level.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.accounts.fifth-level.index') ||
                            request()->routeIs('sites.settings.accounts.fifth-level.create')
                                ? 'active'
                                : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.accounts.fifth-level.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">5th Level</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    @if (Auth::user()->can('sites.settings.countries.index'))
    <li class="menu-item {{ request()->routeIs('sites.settings.countries.index') ||
                    request()->routeIs('sites.settings.countries.create') ||
                    request()->routeIs('sites.settings.countries.edit') ||
                    request()->routeIs('sites.settings.countries.index') ||
                    request()->routeIs('sites.settings.states.index') ||
                    request()->routeIs('sites.settings.states.create') ||
                    request()->routeIs('sites.settings.states.edit') ||
                    request()->routeIs('sites.settings.cities.index') ||
                    request()->routeIs('sites.settings.cities.create') ||
                    request()->routeIs('sites.settings.cities.edit')
                        ? 'active open'
                        : null }}">
      <a class="menu-link menu-toggle" href="javascript:void(0)">

        <span class="menu-title text-truncate">Locations</span>
      </a>
      <ul class="menu-sub">
        @can('sites.settings.countries.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.countries.index') ||
                                request()->routeIs('sites.settings.countries.create') ||
                                request()->routeIs('sites.settings.countries.edit')
                                    ? 'active'
                                    : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.countries.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Countries</span>
          </a>
        </li>
        @endcan

        @can('sites.settings.states.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.states.index') ||
                                request()->routeIs('sites.settings.states.create') ||
                                request()->routeIs('sites.settings.states.edit')
                                    ? 'active'
                                    : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.states.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">States</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.cities.index')
        <li class="menu-item {{ request()->routeIs('sites.settings.cities.index') ||
                                request()->routeIs('sites.settings.cities.create') ||
                                request()->routeIs('sites.settings.cities.edit')
                                    ? 'active'
                                    : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.cities.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Cities</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endif

    @if (Auth::user()->can('sites.trash.sales-plan') ||
    Auth::user()->can('sites.trash.receipts') ||
    Auth::user()->can('sites.trash.application-form') ||
    Auth::user()->can('sites.trash.file') ||
    Auth::user()->can('sites.trash.ledgers') ||
    Auth::user()->can('sites.trash.payment-voucher') ||
    Auth::user()->can('sites.trash.crm-opportunity') ||
    Auth::user()->can('sites.trash.units'))
    <li class="menu-item {{ request()->routeIs('sites.trash.sales-plan') ||
                    request()->routeIs('sites.trash.receipts') ||
                    request()->routeIs('sites.trash.application-form') ||
                    request()->routeIs('sites.trash.file') ||
                    request()->routeIs('sites.trash.ledgers') ||
                    request()->routeIs('sites.trash.payment-voucher') ||
                    request()->routeIs('sites.trash.crm-opportunity') ||
                    request()->routeIs('sites.trash.units')
                        ? 'active open'
                        : null }}">
      <a class="menu-link menu-toggle" href="javascript:void(0)">

        <span class="menu-title text-truncate">Trash</span>
      </a>
      <ul class="menu-sub">
        @can('sites.trash.units')
        <li class="menu-item {{ request()->routeIs('sites.trash.units') ? 'active' : null }}">
          <a class="menu-link" href="{{ route('sites.trash.units', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Units</span>
          </a>
        </li>
        @endcan
        @can('sites.trash.sales-plan')
        <li class="menu-item {{ request()->routeIs('sites.trash.sales-plan') ? 'active' : null }}">
          <a class="menu-link" href="{{ route('sites.trash.sales-plan', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Payment Plan</span>
          </a>
        </li>
        @endcan
        @can('sites.trash.application-form')
        <li class="menu-item {{ request()->routeIs('sites.trash.application-form') ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.trash.application-form', ['site_id' => encryptParams($site_id)]) }}">
            <span class="menu-title text-truncate" data-i18n="Email">Application Form</span>
          </a>
        </li>
        @endcan
        @can('sites.trash.receipts')
        <li class="menu-item {{ request()->routeIs('sites.trash.receipts') ? 'active' : null }}">
          <a class="menu-link" href="{{ route('sites.trash.receipts', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Receipts</span>
          </a>
        </li>
        @endcan

        @can('sites.trash.file')
        <li class="menu-item {{ request()->routeIs('sites.trash.file') ? 'active' : null }}">
          <a class="menu-link" href="{{ route('sites.trash.file', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate" data-i18n="Email">Customer Files</span>
          </a>
        </li>
        @endcan
        @can('sites.trash.ledgers')
        <li class="menu-item {{ request()->routeIs('sites.trash.ledgers') ? 'active' : null }}">
          <a class="menu-link" href="{{ route('sites.trash.ledgers', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate" data-i18n="Email">Ledgers</span>
          </a>
        </li>
        @endcan
        @can('sites.trash.payment-voucher')
        <li class="menu-item {{ request()->routeIs('sites.trash.payment-voucher') ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.trash.payment-voucher', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate" data-i18n="Email">Payment Voucher</span>
          </a>
        </li>
        @endcan
        @can('sites.trash.crm-opportunity')
        <li class="menu-item {{ request()->routeIs('sites.trash.crm-opportunity') ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.trash.crm-opportunity', ['site_id' => encryptParams($site_id)]) }}">
            <span class="menu-title text-truncate" data-i18n="Email">CRM Opportunity</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endif

    @can('sites.settings.social-leads.index')
    <li class="menu-item {{ request()->routeIs('sites.settings.social-leads.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.settings.social-leads.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate" data-i18n="Custom Fields">Leads
          Configuration</span>
      </a>
    </li>
    @endcan
  </ul>
</li>
@endcanany

@canany(['sites.settings.communication-channels.index'])
<li class="menu-header">
  <span data-i18n="Others">Communication Channels</span>
</li>
@endcanany

@can('sites.settings.communication-channels.index')
<li class="menu-item {{ request()->routeIs('sites.settings.communication-channels.index') ||
        request()->routeIs('sites.settings.communication-channels.ajax-transactional.sms.data') ||
        request()->routeIs('sites.settings.communication-channels.ajax-get.notification.body') ||
        request()->routeIs('sites.settings.communication-channels.ajax-promotional.sms.data') ||
        request()->routeIs('sites.settings.communication-channels.ajax-get.notification.error') ||
        request()->routeIs('sites.settings.communication-channels.ajax-promotional.email.data') ||
        request()->routeIs('sites.settings.communication-channels.create') ||
        request()->routeIs('sites.settings.communication-channels.configurations') ||
        request()->routeIs('sites.settings.communication-channels.edit')
            ? 'active open'
            : null }}">
  <a class="menu-link"
    href="{{ route('sites.settings.communication-channels.index', ['site_id' => encryptParams($site_id)]) }}">

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>

    <span class="menu-title text-truncate" data-i18n="Transactional/Reminder">Transactional/Reminder</span>
  </a>
</li>
@endcan

@can('sites.settings.branded-promotional.email-templates.index')
<li class="menu-item {{ request()->routeIs('sites.settings.branded-promotional.email-templates.index') ||
        request()->routeIs('sites.settings.branded-promotional.email-templates.create') ||
        request()->routeIs('sites.settings.branded-promotional.email-templates.edit')
            ? 'active open'
            : null }}">
  <a class="menu-link"
    href="{{ route('sites.settings.branded-promotional.email-templates.index', ['site_id' => encryptParams($site_id)]) }}">
    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.27 27.26">
      <defs>
        <style>
          .cls-1 {
            fill: #6f6372;
          }

          .cls-2 {
            fill: none;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M28.33,12.16a13.55,13.55,0,0,0-1.71-5.29.26.26,0,0,1,0-.32,1.63,1.63,0,0,0,0-2A1.65,1.65,0,0,0,24.67,4a.23.23,0,0,1-.29-.06c-.2-.2-.41-.39-.63-.58A.28.28,0,0,1,23.66,3a1.66,1.66,0,0,0-.73-1.83A1.61,1.61,0,0,0,21,1.29a.27.27,0,0,1-.32,0A13,13,0,0,0,15.81,0,13.21,13.21,0,0,0,8.9,1.37a.3.3,0,0,1-.37,0,1.6,1.6,0,0,0-2-.12,1.61,1.61,0,0,0-.67,1.91.31.31,0,0,1-.12.4A11.68,11.68,0,0,0,4.68,4.58a.4.4,0,0,0,0,.63.42.42,0,0,0,.63-.07c.33-.36.67-.71,1-1a.19.19,0,0,1,.26,0A1.67,1.67,0,0,0,8.87,3.5c.06-.08.09-.13.21-.09a18.08,18.08,0,0,1,4,1.72c.09,0,.14.09.11.21a1.52,1.52,0,0,0,.08.92c.07.15,0,.21-.08.3a18.39,18.39,0,0,0-2.64,2.87.34.34,0,0,1-.37.15,1.64,1.64,0,0,0-1.7.79.29.29,0,0,1-.28.16,25.28,25.28,0,0,0-4.67.5c-.24.05-.41.05-.54-.2a.76.76,0,0,0-.3-.29c-.17-.09-.16-.2-.11-.35A13.29,13.29,0,0,1,4,6.93c.17-.27.13-.5-.1-.64s-.43-.09-.61.2a13,13,0,0,0-1.49,3.4.4.4,0,0,1-.37.35A1.62,1.62,0,0,0,0,11.67a1.65,1.65,0,0,0,1.05,1.79.28.28,0,0,1,.21.32,13,13,0,0,0,.26,2.56,13.76,13.76,0,0,0,4.19,7.4.27.27,0,0,1,.1.31,1.68,1.68,0,0,0,2.59,1.8.29.29,0,0,1,.34,0,13.21,13.21,0,0,0,5.11,1.4,13.29,13.29,0,0,0,7-1.38.33.33,0,0,1,.41,0,1.67,1.67,0,0,0,2.62-1.79.37.37,0,0,1,.13-.44,13.54,13.54,0,0,0,4.21-7.89c.05-.33-.16.49,0,.18,0-.09.18-1.33.18-1.42,0,.08,0,.09,0-.12V13.3c0-.12,0-.23,0-.34s-.1-.94-.1-1.07S28.34,12.3,28.33,12.16ZM7.44,3.45a.85.85,0,0,1-.84-.82.84.84,0,0,1,.84-.87.83.83,0,0,1,.84.85A.83.83,0,0,1,7.44,3.45Zm17.82,1.3a.82.82,0,0,1,.81.86.81.81,0,0,1-.82.82.84.84,0,1,1,0-1.68ZM22,1.76a.84.84,0,0,1,.85.83.8.8,0,0,1-.82.85.81.81,0,0,1-.85-.85A.85.85,0,0,1,22,1.76ZM20.48,3.69c.09,0,.1.06.13.11a1.58,1.58,0,0,0,2.23.42c.09-.06.15-.07.22,0a1.71,1.71,0,0,0,.2.18.57.57,0,0,1,.23.82A1.48,1.48,0,0,0,24,7a.27.27,0,0,1,.12.36,24.11,24.11,0,0,1-2.25,5.06c-.06.12-.12.22-.27.14h-.05c-.43.1-.55-.19-.7-.49a17.73,17.73,0,0,0-4.15-5.38.29.29,0,0,1-.09-.37,1.2,1.2,0,0,0,.07-.77.21.21,0,0,1,.11-.26,17.46,17.46,0,0,1,3.6-1.57Zm1.76,10.79a.83.83,0,0,1-.82.86.86.86,0,0,1,0-1.71A.83.83,0,0,1,22.24,14.48ZM10.52,2.61a.2.2,0,0,1-.17-.18c0-.14.06-.16.14-.2a9.81,9.81,0,0,1,4.42-1A9.64,9.64,0,0,1,19,2.17c.06,0,.19,0,.14.14s0,.28-.17.34A13.65,13.65,0,0,0,15.89,4a.18.18,0,0,1-.24,0A1.29,1.29,0,0,0,14,4a.16.16,0,0,1-.22,0A14.45,14.45,0,0,0,10.52,2.61Zm5.14,3a.81.81,0,0,1-.83.85A.85.85,0,0,1,14,5.66a.87.87,0,0,1,.85-.85A.81.81,0,0,1,15.66,5.65Zm-3.56,4a17.63,17.63,0,0,1,1.92-2,.23.23,0,0,1,.31,0,1.32,1.32,0,0,0,1.28,0,.24.24,0,0,1,.31,0,16.09,16.09,0,0,1,3.71,4.91l.05.12a.18.18,0,0,1-.28.12c-.65-.31-1.31-.61-2-.86a20.69,20.69,0,0,0-5.07-1.26c-.18,0-.22-.15-.31-.26C11.78,10.13,11.89,9.93,12.1,9.69Zm-2.18.71a.84.84,0,1,1,0,1.68.83.83,0,0,1-.83-.85A.84.84,0,0,1,9.92,10.4ZM.84,11.89a.84.84,0,0,1,.84-.84.82.82,0,0,1,.83.85.81.81,0,0,1-.83.84A.85.85,0,0,1,.84,11.89ZM6.1,22.34a11.37,11.37,0,0,1-2.76-4.22,12.33,12.33,0,0,1-.85-3.85c-.05-.18,0-.31.29-.41a1.28,1.28,0,0,0,.8-1.11c0-.16.08-.22.23-.24,1.3-.18,2.59-.37,3.9-.43.13,0,.19,0,.21.16a1.2,1.2,0,0,0,.27.62.24.24,0,0,1,0,.3A16.47,16.47,0,0,0,6.6,21.82c0,.23.06.44-.22.56A.2.2,0,0,1,6.1,22.34Zm1.33,3a.86.86,0,0,1-.83-.86.84.84,0,1,1,1.68,0A.84.84,0,0,1,7.43,25.32Zm1.74-2.41a1.39,1.39,0,0,0-.84-.52c-.17,0-.2-.12-.21-.27,0-.49-.07-1-.06-1.29a17,17,0,0,1,1.63-7.39.22.22,0,0,1,.28-.15,1.54,1.54,0,0,0,1.74-1.06c0-.15.11-.16.23-.14a22.83,22.83,0,0,1,6.32,1.79c.28.13.56.27.84.39s.16.14.14.28a1.49,1.49,0,0,0,.21,1c.08.12,0,.18,0,.26a23.19,23.19,0,0,1-3.72,3.69A23.5,23.5,0,0,1,9.46,23,.21.21,0,0,1,9.17,22.91Zm13.11,2.48a.83.83,0,0,1-.82-.86.8.8,0,0,1,.85-.82.81.81,0,0,1,.82.85A.85.85,0,0,1,22.28,25.39Zm3.48-6.13a12,12,0,0,1-2.7,3.66c-.06.06-.12.17-.23.06s-.33-.05-.3-.32a12.47,12.47,0,0,0,.08-1.93c0-.3-.13-.44-.38-.45s-.39.15-.39.46q0,.92-.09,1.83c0,.13,0,.18-.18.22a1.57,1.57,0,0,0-1.13,1.72.29.29,0,0,1-.2.35,11.83,11.83,0,0,1-4.71,1.22,12.75,12.75,0,0,1-5.67-1.19.3.3,0,0,1-.21-.35c0-.34.19-.45.47-.56a23.94,23.94,0,0,0,10.23-7.44c.11-.13.2-.2.36-.11a.27.27,0,0,0,.17,0c.37,0,.43.2.48.47.09.47.19.94.27,1.42.05.29.22.45.46.41s.36-.22.32-.51a12.23,12.23,0,0,0-.37-1.8.26.26,0,0,1,.11-.31c.14-.11.2,0,.29.05a24.71,24.71,0,0,1,3.25,2.71A.26.26,0,0,1,25.76,19.26Zm1.42-5a11,11,0,0,1-.65,3.08,25.51,25.51,0,0,0-1.93-1.7l-1.11-.82a.23.23,0,0,1-.14-.29,1.42,1.42,0,0,0-.31-1.2.16.16,0,0,1,0-.23,21.78,21.78,0,0,0,2.14-4.87c.08-.26.33-.13.48-.21s.14.09.17.15A11,11,0,0,1,27.18,14.22Z" />
          <path class="cls-2" d="M30.42,10.9c0,4.18.83,7.57,1.85,7.57" />
        </g>
      </g>
    </svg> --}}
    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="34" height="19" viewBox="0 0 34 19" fill="none">
      <path
        d="M4.81494 11.9C3.81494 11.9 2.71494 11.9 1.71494 11.9C1.21494 11.9 0.814941 11.6 0.814941 11.2C0.814941 10.8 1.11494 10.5 1.71494 10.5C3.81494 10.5 5.91494 10.5 7.91494 10.5C8.41494 10.5 8.71494 10.8 8.81494 11.2C8.81494 11.7 8.51494 11.9 8.01494 11.9C6.91494 11.9 5.91494 11.9 4.81494 11.9Z"
        fill="#706473" />
      <path
        d="M5.91514 6.8999C6.61514 6.8999 7.31514 6.8999 7.91514 6.8999C8.41514 6.8999 8.71514 7.1999 8.71514 7.5999C8.71514 7.9999 8.41514 8.3999 7.91514 8.3999C6.51514 8.3999 5.21514 8.3999 3.81514 8.3999C3.41514 8.2999 3.01514 7.9999 3.01514 7.5999C3.01514 7.1999 3.41514 6.8999 3.81514 6.8999C4.61514 6.8999 5.21514 6.8999 5.91514 6.8999Z"
        fill="#706473" />
      <path
        d="M33.4148 3C33.4148 2.7 33.4148 2.5 33.3148 2.2C32.9148 0.8 31.8148 0 30.3148 0C24.0148 0 17.7148 0 11.3148 0C10.2148 0 9.11476 0 8.01476 0C6.61476 0 5.51476 1 5.31476 2.3C5.21476 2.8 5.31476 3.3 5.21476 3.8C5.21476 4.3 5.51476 4.7 5.91476 4.7C6.31476 4.7 6.61476 4.4 6.61476 3.9C6.61476 3.5 6.61476 3.2 6.61476 2.8C6.61476 2.7 6.61476 2.6 6.71476 2.5C6.81476 2.4 6.91476 2.6 7.01476 2.6C9.51476 4.8 12.0148 6.9 14.5148 9.1C14.7148 9.3 14.7148 9.4 14.5148 9.6C12.4148 11.3 10.4148 13.1 8.31476 14.9C7.81476 15.4 7.21476 15.8 6.61476 16.3C6.51476 15.8 6.61476 15.4 6.61476 15C6.61476 14.8 6.61476 14.7 6.51476 14.5C6.41476 14.2 6.11476 14 5.71476 14C5.41476 14 5.11476 14.3 5.11476 14.6C5.11476 15.2 5.01476 15.7 5.11476 16.3C5.31476 17.7 6.61476 18.7 8.11476 18.7C15.4148 18.7 22.8148 18.7 30.1148 18.7C30.3148 18.7 30.6148 18.7 30.8148 18.6C32.2148 18.3 33.1148 17.2 33.1148 15.6C33.4148 11.5 33.4148 7.3 33.4148 3ZM8.11476 1.7C8.01476 1.7 8.01476 1.6 7.81476 1.5C15.5148 1.5 23.1148 1.5 30.7148 1.5C30.5148 1.7 30.4148 1.8 30.2148 1.9C26.8148 4.8 23.3148 7.8 19.9148 10.7C19.3148 11.2 19.1148 11.2 18.4148 10.7C15.1148 7.7 11.6148 4.7 8.11476 1.7ZM7.81476 17.3C8.41476 16.8 8.91476 16.4 9.41476 16C11.5148 14.2 13.6148 12.4 15.7148 10.6C15.9148 10.4 16.0148 10.4 16.2148 10.6C16.7148 11.1 17.3148 11.6 17.9148 12.1C18.8148 12.8 19.9148 12.8 20.7148 12.1C21.3148 11.6 21.9148 11.1 22.5148 10.6C22.6148 10.5 22.7148 10.5 22.9148 10.6C25.5148 12.8 28.1148 15.1 30.7148 17.3L30.8148 17.4C23.1148 17.3 15.5148 17.3 7.81476 17.3ZM31.9148 16.3C31.0148 15.5 30.2148 14.8 29.3148 14.1C27.5148 12.6 25.8148 11.1 24.0148 9.6C23.8148 9.4 23.8148 9.4 24.0148 9.2C26.6148 7 29.2148 4.8 31.7148 2.6C31.7148 2.6 31.8148 2.6 31.9148 2.5C31.9148 7.1 31.9148 11.7 31.9148 16.3Z"
        fill="#706473" />
    </svg>

    <span class="menu-title text-truncate" data-i18n="Branded/Promotional Email">Promotional
      Email</span>
  </a>
</li>
@endcan

@can('sites.settings.branded-promotional.sms-templates.index')
<li class="menu-item {{ request()->routeIs('sites.settings.branded-promotional.sms-templates.index') ||
        request()->routeIs('sites.settings.branded-promotional.sms-templates.create') ||
        request()->routeIs('sites.settings.branded-promotional.sms-templates.edit')
            ? 'active open'
            : null }}">
  <a class="menu-link"
    href="{{ route('sites.settings.branded-promotional.sms-templates.index', ['site_id' => encryptParams($site_id)]) }}">
    {{-- <i class="bi bi-clock-history"></i> --}}
    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="28" viewBox="0 0 30 28" fill="none">
      <path
        d="M29.315 3.20005C29.115 1.80005 27.915 0.800049 26.415 0.800049C21.015 0.800049 15.615 0.800049 10.215 0.800049C8.91503 0.800049 7.71504 1.90005 7.51504 3.20005C7.41504 4.10005 7.51504 4.90005 7.51504 5.80005C7.51504 6.00005 7.41503 6.10005 7.21503 6.10005C6.11503 6.10005 4.91504 6.10005 3.81504 6.10005C2.11504 6.10005 0.915039 7.50005 0.915039 9.10005C0.915039 12.4 0.915039 15.8 0.915039 19.1C0.915039 20.5 2.21504 21.8 3.61504 21.8C4.51504 21.8 5.41504 21.8 6.41504 21.8C6.61504 21.8 6.71503 21.9 6.71503 22.1C6.71503 23.4 6.71503 24.7 6.71503 26C6.71503 26.2 6.71503 26.4 6.71503 26.6C6.71503 26.8 6.81504 27 7.01504 27.1C7.21504 27.2 7.41504 27.1 7.51504 27C7.61504 26.9 7.71503 26.8001 7.71503 26.7001C9.11503 25.2001 10.515 23.7 11.815 22.1C11.915 21.9 12.115 21.9001 12.315 21.9001C14.815 21.9001 17.315 21.9001 19.815 21.9001C21.215 21.9001 22.315 21.1001 22.715 19.7001C22.815 19.5001 22.815 19.3 22.815 19C23.215 19.5 23.715 20.0001 24.115 20.4001C24.515 20.8001 24.815 21.2 25.215 21.6C25.415 21.8 25.515 21.8 25.815 21.8C26.015 21.7 26.115 21.5 26.115 21.3C26.115 21.2 26.115 21.2 26.115 21.1C26.115 19.7 26.115 18.4 26.115 17C26.115 16.6 26.115 16.6 26.515 16.6C27.515 16.6 28.315 16.2001 28.915 15.4001C29.215 15.1001 29.315 14.6001 29.415 14.2001C29.315 10.5001 29.315 6.80005 29.315 3.20005ZM19.415 20.5C16.915 20.5 14.415 20.5 11.915 20.5C11.615 20.5 11.415 20.6 11.215 20.8C10.115 22.1 8.91504 23.3 7.81504 24.6C7.71504 24.7 7.71504 24.7 7.61504 24.8C7.61504 23.6 7.61504 22.4001 7.61504 21.2001C7.61504 20.6001 7.51504 20.5 6.91504 20.5C5.91504 20.5 4.91504 20.5 4.01504 20.5C3.11504 20.5 2.41503 20.0001 2.21503 19.2001C2.11503 19.0001 2.11504 18.8 2.11504 18.6C2.11504 15.5 2.11504 12.4 2.11504 9.30005C2.11504 8.30005 2.61504 7.60005 3.51504 7.40005C3.71504 7.40005 3.81504 7.40005 4.01504 7.40005C9.11504 7.40005 14.315 7.40005 19.415 7.40005C20.315 7.40005 21.015 7.90005 21.315 8.80005C21.315 9.00005 21.315 9.20005 21.315 9.30005C21.315 12.4 21.315 15.6001 21.315 18.7001C21.415 19.7001 20.515 20.5 19.415 20.5ZM27.915 13.3C27.915 14.5 27.215 15.2001 25.915 15.2001C25.715 15.2001 25.515 15.2001 25.215 15.2001C24.815 15.2001 24.615 15.4 24.615 15.8C24.615 17 24.615 18.2 24.615 19.5C23.815 18.7 23.115 17.9 22.415 17.1C22.315 17 22.315 16.9 22.315 16.8C22.315 14.2 22.315 11.6 22.315 9.00005C22.315 7.80005 21.815 7.00005 20.815 6.40005C20.515 6.20005 20.115 6.10005 19.815 6.10005C16.215 6.10005 12.615 6.10005 9.11504 6.10005C8.91504 6.10005 8.81504 6.10005 8.81504 5.80005C8.81504 5.20005 8.81504 4.50005 8.81504 3.90005C8.81504 2.90005 9.51503 2.00005 10.715 2.00005C13.715 2.00005 16.615 2.00005 19.615 2.00005C21.715 2.00005 23.915 2.00005 26.015 2.00005C26.915 2.00005 27.515 2.50005 27.815 3.30005C27.915 3.50005 27.915 3.70005 27.915 3.90005C27.915 7.20005 27.915 10.3 27.915 13.3Z"
        fill="#6A6270" />
      <path
        d="M11.7152 14.5001C9.71523 14.5001 7.71524 14.5001 5.81524 14.5001C5.71524 14.5001 5.61524 14.5001 5.41524 14.5001C5.21524 14.4001 5.11523 14.3001 5.11523 14.1001C5.11523 13.9001 5.21524 13.7001 5.41524 13.6001C5.51524 13.6001 5.61524 13.6001 5.81524 13.6001C9.71524 13.6001 13.7152 13.6001 17.6152 13.6001C18.1152 13.6001 18.4152 13.8001 18.3152 14.1001C18.3152 14.4001 18.0152 14.6001 17.6152 14.6001C15.7152 14.5001 13.7152 14.5001 11.7152 14.5001Z"
        fill="#6A6270" />
      <path
        d="M11.7152 17.4001C9.71523 17.4001 7.71523 17.4001 5.71523 17.4001C5.31523 17.4001 5.11523 17.2001 5.11523 16.9001C5.11523 16.7001 5.21524 16.5001 5.51524 16.4001C5.61524 16.4001 5.71524 16.4001 5.91524 16.4001C9.91524 16.4001 13.8152 16.4001 17.8152 16.4001C18.3152 16.4001 18.5152 16.6001 18.5152 16.9001C18.5152 17.2001 18.3152 17.4001 17.8152 17.4001C15.7152 17.4001 13.7152 17.4001 11.7152 17.4001Z"
        fill="#6A6270" />
      <path
        d="M8.61523 10.7001C9.61523 10.7001 10.6152 10.7001 11.6152 10.7001C11.8152 10.7001 12.1152 10.8001 12.2152 11.0001C12.3152 11.3001 12.2152 11.5001 11.9152 11.6001C11.8152 11.6001 11.8152 11.6001 11.7152 11.6001C9.71523 11.6001 7.71523 11.6001 5.71523 11.6001C5.31523 11.6001 5.11523 11.4001 5.11523 11.1001C5.11523 10.8001 5.31523 10.6001 5.71523 10.6001C6.71523 10.7001 7.61523 10.7001 8.61523 10.7001Z"
        fill="#6A6270" />
    </svg>

    <span class="menu-title text-truncate" data-i18n="Branded/Promotional SMS">Promotional SMS</span>
  </a>
</li>
@endcan

{{-- Chat --}}
{{-- @canany(['sites.internal-stakeholder-chat.index'])
<li class="menu-header">
  <span data-i18n="Others">CHAT</span>
</li>
@endcanany
@canany(['sites.internal-stakeholder-chat.index'])
<li class="menu-item {{ request()->routeIs('sites.internal-stakeholder-chat.index') ? 'active' : null }}">
  <a class="menu-link"
    href="{{ route('sites.internal-stakeholder-chat.index', ['site_id' => encryptParams($site_id)]) }}">
    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 22.75">
      <defs>
        <style>
          .cls-1 {
            fill: #6b6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M5.39,9.28H7.31a.4.4,0,0,1,.4.38.4.4,0,0,1-.38.43h-3a.41.41,0,0,1-.26-.71l.68-.65A5.09,5.09,0,0,1,3.25,6.13,5,5,0,0,1,4.81,1.35,4.85,4.85,0,0,1,10.46.57c.3.14.4.37.28.6s-.35.27-.64.13a4.19,4.19,0,0,0-5,.93,4.25,4.25,0,0,0,.36,6c.42.36.42.5,0,.9a.22.22,0,0,1-.11,0Z" />
          <path class="cls-1"
            d="M9.18,20.91A3.25,3.25,0,0,0,8.8,20a4.77,4.77,0,0,0-4.13-2.47,1.89,1.89,0,0,1-2-2.21,1.85,1.85,0,0,1,2.12-1.7,2,2,0,0,1,1.4,3.08c-.18.28-.16.5.06.65s.45.07.63-.2a2.73,2.73,0,0,0,.44-2.05A2.8,2.8,0,0,0,4,12.86a2.83,2.83,0,0,0-2.06,3.41A2.79,2.79,0,0,0,3,17.83,4.78,4.78,0,0,0,.09,20.76a1.49,1.49,0,0,0,1.36,2q3.17,0,6.32,0A1.49,1.49,0,0,0,9.18,20.91Zm-1.53,1H1.59a.72.72,0,0,1-.75-.52.6.6,0,0,1,0-.44,4,4,0,0,1,3.74-2.6A3.93,3.93,0,0,1,8.33,21,.68.68,0,0,1,7.65,21.94Z" />
          <path class="cls-1"
            d="M20.88,20.64a4.82,4.82,0,0,0-2.83-2.81,2.79,2.79,0,1,0-4.43-2.49,2.67,2.67,0,0,0,.5,1.87.46.46,0,0,0,.65.14c.19-.15.2-.38,0-.63a2,2,0,1,1,1.55.82,4.71,4.71,0,0,0-4.42,3.11,1.49,1.49,0,0,0,1.45,2.1h6.06A1.5,1.5,0,0,0,20.88,20.64Zm-1.45,1.3c-1,0-2,0-3,0h-3a.7.7,0,0,1-.72-1.06,4,4,0,0,1,7.42.06A.72.72,0,0,1,19.43,21.94Z" />
          <path class="cls-1"
            d="M16.9,11l-.62-.59a4.79,4.79,0,0,0,1.51-4.35A5,5,0,1,0,7.89,7.7a4.91,4.91,0,0,0,5,4.08c1.21,0,2.43,0,3.65,0a.46.46,0,0,0,.48-.26A.44.44,0,0,0,16.9,11Zm-1.29-1.1c-.45.41-.45.5,0,.94a.11.11,0,0,1,0,.13,22.32,22.32,0,0,1-3.83-.16A4.17,4.17,0,0,1,8.61,6.71a4.1,4.1,0,0,1,3.46-4.1A4.13,4.13,0,0,1,17,6.43,4.11,4.11,0,0,1,15.61,9.91Z" />
          <path class="cls-1"
            d="M13,6.76h2.46c.3,0,.49.15.5.39s-.19.42-.49.42h-4.9c-.32,0-.49-.15-.48-.42s.17-.39.48-.39Z" />
          <path class="cls-1"
            d="M12.19,5.07h1.6c.31,0,.47.14.48.4s-.18.41-.49.41c-1.06,0-2.12,0-3.17,0-.32,0-.51-.15-.51-.4s.18-.41.5-.41Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate">Internal Stakheolders Chat</span>
    </span>
  </a>
</li>
@endcanany --}}

@canany(['sites.crm.opportunity.index', 'sites.crm.opportunity.list'])
<li class="menu-header">
  <span data-i18n="Others">CRM</span>
</li>
@endcanany
@canany(['sites.crm.opportunity.index', 'sites.crm.opportunity.list'])
<li class="menu-item {{ request()->routeIs('sites.crm.opportunity.index') || request()->routeIs('sites.crm.opportunity.list')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="javascript:void(0)">
    {{-- <i data-feather='users'></i> --}}
    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
      <g clip-path="url(#clip0_67_63)">
        <path
          d="M24.2999 20.5C23.6999 19.4 23.0999 18.4 22.4999 17.3C22.3999 17.1 22.2999 17 22.0999 17.1C21.6999 17.1 21.2999 17.1 20.9999 17.1C20.7999 17.1 20.7999 17.1 20.7999 16.9C20.7999 15.4 20.7999 13.8 20.7999 12.3C20.7999 12 20.6999 11.8 20.2999 11.8C19.6999 11.8 19.0999 11.8 18.4999 11.8C18.3999 11.8 18.2999 11.8 18.2999 11.6C18.0999 10.1 17.4999 8.9 16.4999 7.8C15.4999 6.8 14.2999 6.3 12.8999 6.1C12.6999 6.1 12.5999 6 12.5999 5.8C12.5999 5.3 12.5999 4.7 12.5999 4.2C12.5999 4 12.5999 4 12.7999 4C13.8999 4 15.0999 4 16.1999 4C16.3999 4 16.3999 4.1 16.4999 4.2C16.9999 5.1 17.4999 6 17.9999 7C18.0999 7.2 18.2999 7.3 18.4999 7.3C19.6999 7.3 20.7999 7.3 21.9999 7.3C22.1999 7.3 22.3999 7.2 22.4999 7C23.0999 6 23.5999 5 24.1999 3.9C24.2999 3.7 24.2999 3.5 24.1999 3.3C23.5999 2.3 23.0999 1.3 22.4999 0.3C22.4999 0.1 22.2999 0 22.0999 0C20.9999 0 19.7999 0 18.6999 0C18.3999 0 18.1999 0.1 18.0999 0.4C17.5999 1.3 17.0999 2.2 16.5999 3.1C16.4999 3.2 16.3999 3.3 16.2999 3.3C14.9999 3.3 13.6999 3.3 12.3999 3.3C12.0999 3.3 11.8999 3.4 11.8999 3.8C11.8999 4.5 11.8999 5.2 11.8999 5.9C11.8999 6.1 11.7999 6.2 11.5999 6.2C9.3999 6.4 7.8999 7.5 6.7999 9.3C6.3999 10 6.1999 10.7 6.0999 11.5C6.0999 11.7 5.9999 11.8 5.7999 11.8C5.3999 11.8 4.9999 11.8 4.5999 11.8C4.4999 11.8 4.3999 11.8 4.3999 11.6C4.3999 10.2 4.3999 8.8 4.3999 7.4C4.3999 7.3 4.3999 7.2 4.5999 7.2C4.9999 7.2 5.3999 7.2 5.7999 7.2C5.9999 7.2 6.1999 7.1 6.2999 6.9C6.8999 6 7.4999 5 8.0999 3.9C8.1999 3.7 8.1999 3.6 8.0999 3.4C7.4999 2.4 6.8999 1.3 6.2999 0.3C6.1999 0.1 5.9999 0 5.7999 0C4.6999 0 3.4999 0 2.2999 0C2.0999 0 1.9999 0.1 1.7999 0.3C1.2999 1.3 0.699902 2.4 0.0999023 3.4C-9.76548e-05 3.6 -9.76548e-05 3.7 0.0999023 3.9C0.699902 5 1.2999 6 1.7999 7.1C1.8999 7.3 1.9999 7.4 2.2999 7.4C2.6999 7.4 3.0999 7.4 3.4999 7.4C3.6999 7.4 3.6999 7.4 3.6999 7.6C3.6999 8.4 3.6999 9.1 3.6999 9.9C3.6999 10.7 3.6999 11.4 3.6999 12.2C3.6999 12.6 3.7999 12.7 4.1999 12.7C4.6999 12.7 5.1999 12.7 5.5999 12.7C6.0999 12.7 6.0999 12.7 6.1999 13.2C6.5999 16 8.8999 18.1 11.6999 18.4C11.8999 18.4 11.8999 18.5 11.8999 18.6C11.8999 19.1 11.8999 19.7 11.8999 20.2C11.8999 20.4 11.8999 20.4 11.6999 20.4C10.5999 20.4 9.3999 20.4 8.2999 20.4C8.0999 20.4 8.0999 20.3 7.9999 20.2C7.4999 19.3 6.9999 18.3 6.3999 17.4C6.2999 17.2 6.0999 17.1 5.8999 17.1C4.6999 17.1 3.5999 17.1 2.3999 17.1C2.0999 17.1 1.9999 17.2 1.8999 17.4C1.2999 18.4 0.799902 19.4 0.199902 20.4C0.0999023 20.6 0.0999023 20.8 0.199902 21.1C0.799902 22.1 1.2999 23.1 1.8999 24.1C1.9999 24.3 2.1999 24.4 2.4999 24.4C3.5999 24.4 4.7999 24.4 5.8999 24.4C6.1999 24.4 6.2999 24.3 6.4999 24.1C6.9999 23.2 7.4999 22.3 7.9999 21.4C8.0999 21.3 8.1999 21.2 8.2999 21.2C9.5999 21.2 10.8999 21.2 12.2999 21.2C12.5999 21.2 12.7999 21.1 12.7999 20.7C12.7999 20.1 12.7999 19.5 12.7999 19C12.7999 18.8 12.6999 18.5 12.7999 18.4C12.8999 18.3 13.1999 18.3 13.3999 18.3C16.0999 17.8 18.1999 15.6 18.4999 12.8C18.4999 12.7 18.5999 12.6 18.6999 12.6C19.0999 12.6 19.4999 12.6 19.9999 12.6C20.0999 12.6 20.1999 12.6 20.1999 12.8C20.1999 14.2 20.1999 15.5 20.1999 16.9C20.1999 17.1 20.0999 17.1 19.9999 17.1C19.5999 17.1 19.1999 17.1 18.8999 17.1C18.6999 17.1 18.4999 17.2 18.3999 17.4C17.7999 18.4 17.1999 19.5 16.5999 20.5C16.4999 20.7 16.4999 20.8 16.5999 21C17.1999 22.1 17.7999 23.1 18.3999 24.2C18.4999 24.4 18.5999 24.5 18.7999 24.5C19.9999 24.5 21.1999 24.5 22.3999 24.5C22.5999 24.5 22.6999 24.4 22.7999 24.3C23.3999 23.2 23.9999 22.2 24.5999 21.1C24.3999 20.8 24.3999 20.7 24.2999 20.5ZM17.6999 3.5C18.0999 2.8 18.4999 2.1 18.8999 1.3C18.9999 1.3 18.9999 1.2 19.0999 1.2C19.8999 1.2 20.6999 1.2 21.4999 1.2C21.5999 1.2 21.6999 1.2 21.6999 1.4C22.0999 2.1 22.4999 2.8 22.8999 3.5C22.9999 3.6 22.9999 3.7 22.9999 3.8C22.5999 4.5 22.1999 5.2 21.7999 5.9C21.6999 6 21.6999 6.1 21.4999 6.1C21.0999 6.1 20.6999 6.1 20.2999 6.1C19.8999 6.1 19.4999 6.1 19.0999 6.1C18.9999 6.1 18.8999 6.1 18.8999 6C18.4999 5.3 18.0999 4.6 17.6999 3.8C17.5999 3.7 17.5999 3.6 17.6999 3.5ZM2.8999 6.1C2.7999 6.1 2.6999 6.1 2.6999 6C2.1999 5.2 1.7999 4.5 1.3999 3.8C1.2999 3.7 1.2999 3.6 1.3999 3.5C1.7999 2.8 2.1999 2.1 2.5999 1.4C2.6999 1.3 2.6999 1.3 2.7999 1.3C3.1999 1.3 3.5999 1.3 3.9999 1.3C4.3999 1.3 4.7999 1.3 5.1999 1.3C5.2999 1.3 5.3999 1.3 5.3999 1.4C5.7999 2.1 6.1999 2.8 6.5999 3.6C6.6999 3.7 6.6999 3.8 6.5999 3.9C6.2999 4.5 5.8999 5.2 5.4999 6C5.3999 6.1 5.3999 6.1 5.2999 6.1C4.4999 6.1 3.6999 6.1 2.8999 6.1ZM6.6999 20.9C6.2999 21.6 5.8999 22.3 5.4999 23C5.3999 23.1 5.3999 23.2 5.1999 23.2C4.7999 23.2 4.3999 23.2 3.9999 23.2C3.5999 23.2 3.1999 23.2 2.7999 23.2C2.6999 23.2 2.5999 23.2 2.4999 23.1C2.0999 22.4 1.6999 21.7 1.2999 21C1.1999 20.9 1.1999 20.8 1.2999 20.7C1.6999 20 2.0999 19.3 2.4999 18.6C2.5999 18.5 2.5999 18.4 2.6999 18.4C3.4999 18.4 4.2999 18.4 5.0999 18.4C5.1999 18.4 5.2999 18.4 5.2999 18.6C5.6999 19.3 6.0999 20 6.4999 20.7C6.7999 20.7 6.7999 20.8 6.6999 20.9ZM12.0999 17C9.4999 17 7.3999 14.8 7.3999 12.1C7.3999 9.5 9.5999 7.3 12.2999 7.4C14.8999 7.5 16.9999 9.6 16.9999 12.2C16.8999 14.9 14.7999 17 12.0999 17ZM22.9999 20.9C22.5999 21.6 22.1999 22.3 21.7999 23C21.6999 23.1 21.6999 23.1 21.5999 23.1C21.1999 23.1 20.7999 23.1 20.3999 23.1C19.9999 23.1 19.5999 23.1 19.1999 23.1C19.0999 23.1 18.9999 23.1 18.9999 23C18.5999 22.3 18.1999 21.6 17.7999 20.8C17.6999 20.7 17.6999 20.6 17.7999 20.5C18.1999 19.8 18.5999 19.1 18.9999 18.3C19.0999 18.2 19.0999 18.2 19.1999 18.2C19.9999 18.2 20.7999 18.2 21.5999 18.2C21.6999 18.2 21.7999 18.2 21.7999 18.3C22.1999 19 22.5999 19.7 22.9999 20.4C22.9999 20.7 22.9999 20.8 22.9999 20.9Z"
          fill="#64606F" />
        <path
          d="M14.2 12.3C14.2 11.6 14 11.1 13.4 10.6C13.3 10.5 13.3 10.5 13.4 10.4C13.7 9.99996 13.8 9.59996 13.8 9.09996C13.7 8.39996 13.1 7.89996 12.5 7.79996C11.9 7.69996 11.2 7.99996 10.8 8.59996C10.4 9.19996 10.5 9.89996 10.9 10.4C11 10.5 11 10.6 10.9 10.7C10.4 11.1 10.2 11.7 10.2 12.3C10.2 12.8 10.2 13.3 10.2 13.8C10.2 14.4 10.2 14.9 10.2 15.5C10.2 15.9 10.3 16 10.7 16C11.7 16 12.7 16 13.8 16C14.2 16 14.3 15.9 14.3 15.5C14.2 14.3 14.2 13.3 14.2 12.3ZM12.2 8.79996C12.5 8.79996 12.7 9.09996 12.8 9.29996C12.8 9.59996 12.6 9.79996 12.3 9.89996C12 9.89996 11.7 9.59996 11.7 9.29996C11.7 9.09996 11.9 8.79996 12.2 8.79996ZM13 13.4C13 13.7 13 14 13 14.3C13 14.4 13 14.4 12.9 14.4C12.4 14.4 12 14.4 11.5 14.4C11.4 14.4 11.4 14.4 11.4 14.3C11.4 13.7 11.4 13.1 11.4 12.5C11.4 12 11.8 11.7 12.2 11.7C12.6 11.7 13 12 13 12.5C13 12.8 13 13.1 13 13.4Z"
          fill="#64606F" />
      </g>
      <defs>
        <clipPath id="clip0_67_63">
          <rect width="24.4" height="24.4" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate">
      CRM</span>
  </a>
  <ul class="menu-sub">
    @can('sites.crm.opportunity.index')
    <li class="menu-item {{ request()->routeIs('sites.crm.opportunity.index') ? 'active' : null }}">
      <a class="menu-link" href="{{ route('sites.crm.opportunity.index', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" class="menu-icon" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate">Board
        </span>
      </a>
    </li>
    @endcan
    @can('sites.crm.opportunity.list')
    <li class="menu-item {{ request()->routeIs('sites.crm.opportunity.list') ? 'active' : null }}">
      <a class="menu-link" href="{{ route('sites.crm.opportunity.list', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" class="menu-icon" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate">List
        </span>
      </a>
    </li>
    @endcan
  </ul>
</li>
@endcanany

@canany(['sites.blacklisted-stakeholders.index', 'sites.stakeholders.index'])
<li class="menu-header">
  <span data-i18n="Others">Others</span>
</li>
@endcanany

@canany(['sites.stakeholders.index', 'sites.users.index', 'sites.blacklisted-stakeholders.index'])
<li class="menu-item {{ request()->routeIs('sites.blacklisted-stakeholders.index') ||
        request()->routeIs('sites.blacklisted-stakeholders.create') ||
        request()->routeIs('sites.blacklisted-stakeholders.edit') ||
        request()->routeIs('sites.temp-stakeholders.index') ||
        request()->routeIs('sites.stakeholders.index') ||
        request()->routeIs('sites.stakeholders.create') ||
        request()->routeIs('sites.stakeholders.edit') ||
        request()->routeIs('sites.users.index') ||
        request()->routeIs('sites.users.create') ||
        request()->routeIs('sites.users.edit') ||
        request()->routeIs('sites.users.editPermissions') ||
        request()->routeIs('sites.teams.index') ||
        request()->routeIs('sites.teams.create') ||
        request()->routeIs('sites.teams.edit') ||
        request()->routeIs('sites.stakeholders.profile.stakeholder-profile')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="javascript:void(0)">
    <img class="menu-icon" src="{{ asset('assets/sitebar-icon/stack-holder.svg') }}" />
    <span class="menu-title text-truncate">
      Stakeholders</span>
  </a>
  <ul class="menu-sub">
    @can('sites.blacklisted-stakeholders.index')
    <li class="menu-item {{ request()->routeIs('sites.blacklisted-stakeholders.index') ||
                    request()->routeIs('sites.blacklisted-stakeholders.create') ||
                    request()->routeIs('sites.blacklisted-stakeholders.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.blacklisted-stakeholders.index', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>

        <span class="menu-title text-truncate">Blacklisted
        </span>
      </a>
    </li>
    @endcan
    @can('sites.temp-stakeholders.index')
    <li class="menu-item {{ request()->routeIs('sites.temp-stakeholders.index') ? 'active' : null }}">
      <a class="menu-link" href="{{ route('sites.temp-stakeholders.index', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>

        <span class="menu-title text-truncate">Temp
        </span>
      </a>
    </li>
    @endcan
    @can('sites.stakeholders.index')
    <li class="menu-item {{ request()->routeIs('sites.stakeholders.index') ||
                    request()->routeIs('sites.stakeholders.create') ||
                    request()->routeIs('sites.stakeholders.edit') ||
                    request()->routeIs('sites.stakeholders.profile.stakeholder-profile')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.stakeholders.index', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>

        <span class="menu-title text-truncate">External </span>
      </a>
    </li>
    @endcan

    @if (Auth::user()->can('sites.teams.index') || Auth::user()->can('sites.users.index'))
    <li class="menu-item {{ request()->routeIs('sites.users.index') ||
                    request()->routeIs('sites.users.create') ||
                    request()->routeIs('sites.users.edit') ||
                    request()->routeIs('sites.users.editPermissions') ||
                    request()->routeIs('sites.teams.index') ||
                    request()->routeIs('sites.teams.create') ||
                    request()->routeIs('sites.teams.edit')
                        ? 'active open'
                        : null }}">
      <a class="menu-link menu-toggle" href="javascript:void(0)">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate">
          Internal </span>
      </a>
      <ul class="menu-sub ">

        @can('sites.users.index')
        <li class="menu-item {{ request()->routeIs('sites.users.index') ||
                                request()->routeIs('sites.users.create') ||
                                request()->routeIs('sites.users.edit') ||
                                request()->routeIs('sites.users.editPermissions')
                                    ? 'active'
                                    : null }}">
          <a class="menu-link" href="{{ route('sites.users.index', ['site_id' => encryptParams(1)]) }}">

            <span class="menu-title text-truncate">Users</span>
          </a>
        </li>
        @endcan

        @can('sites.teams.index')
        <li class="menu-item {{ request()->routeIs('sites.teams.index') ||
                                request()->routeIs('sites.teams.create') ||
                                request()->routeIs('sites.teams.edit')
                                    ? 'active'
                                    : null }}">
          <a class="menu-link" href="{{ route('sites.teams.index', ['site_id' => encryptParams(1)]) }}">

            <span class="menu-title text-truncate">Department</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endif
  </ul>
</li>
@endcanany

{{-- Floors Menu --}}
@can('sites.floors.index')
<li class="menu-item {{ request()->routeIs('sites.floors.index', ['site_id' => encryptParams($site_id)]) ||
        request()->routeIs('sites.floors.create') ||
        request()->routeIs('sites.floors.edit') ||
        request()->routeIs('sites.floors.floor-plan')
            ? 'active'
            : null }}">
  <a class="menu-link" href="{{ route('sites.floors.index', ['site_id' => encryptParams($site_id)]) }}">

    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27" fill="none">
      <g clip-path="url(#clip0_58_29)">
        <path
          d="M23.6 16.5C23.4 16.4 23.1 16.2 22.8 16.1C23.1 15.9 23.4 15.8 23.7 15.6C25.5 14.6 25.4 12.1 23.7 11.1C23.4 10.9 23.1 10.8 22.8 10.6C23.1 10.4 23.3 10.3 23.6 10.1C24.5 9.6 25 8.9 25 7.8C25 6.8 24.5 6 23.6 5.5C20.7 3.9 17.7 2.2 14.8 0.6C14.4 0.4 13.9 0.2 13.4 0.1C13.3 0.1 13.1 0.1 13 0C12.6 0 12.3 0 11.9 0C11.9 0 11.9 0 11.8 0C11.2 0.1 10.6 0.3 10.1 0.6C7.3 2.3 4.4 3.9 1.4 5.5C0.5 6 0 6.2 0 7.2C0 8.3 0.5 9.6 1.4 10.1C1.6 10.2 1.9 10.4 2.2 10.5C1.9 10.7 1.6 10.8 1.4 11C0.5 11.6 0 11.7 0 12.7C0 13.7 0.5 15.1 1.4 15.6C1.7 15.7 1.9 15.9 2.2 16.1C1.9 16.3 1.7 16.4 1.4 16.5C0.5 17 0 17.2 0 18.2C0 19.2 0.5 20.6 1.4 21.1C4.4 22.7 7.3 24.4 10.3 26C11.8 26.8 13.3 26.8 14.8 26C15.3 25.7 15.5 25.3 15.3 24.8C15.1 24.1 14.7 24.3 14.1 24.7C13.3 25.1 12.1 25.1 11.2 24.7C8.3 23.4 5.7 21.3 2.4 19.9C2.2 19.8 1.7 18.9 1.7 18.6C1.7 18.3 1.8 18 2 17.8C2.6 17.3 3.3 16.9 4.2 17.2C4.4 17.3 4.5 17.2 4.6 17.3C6.5 18.4 8.3 19.4 10.2 20.4C11.7 21.3 13.3 21.3 14.8 20.4C16.7 19.4 18.6 18.3 20.4 17.3C20.5 17.3 21 16.9 21.1 16.9C22.1 17.1 22.6 17.4 22.9 17.9C23.1 18.2 23.5 19.1 23.1 19.3C23 19.4 22.4 19.9 22.3 19.9C21 20.6 19.9 21.2 18.6 21.9C18.1 22.2 17.9 22.4 18 22.9C18.2 23.6 18.6 23.7 19.3 23.3C20.7 22.5 22.1 21.7 23.5 21C24.4 20.5 24.9 19.7 24.9 18.7C25 17.8 24.5 17 23.6 16.5ZM1.3 7.9C1.3 7.6 1.3 7.2 1.5 7.1C4.5 5.5 8.3 3.3 11.3 1.7C12.1 1.3 12.7 1.1 13.5 1.6C16.5 3.3 20.4 5.6 23.4 7.3C23.8 7.5 23.6 8.7 23.1 8.9C20.1 10.6 16.9 12.1 14 13.8C13.6 14 12.9 14.3 12.5 14.4C12.1 14.4 11.7 14.2 11.4 14C8.4 12.3 4.7 10.5 1.8 8.9C1.5 8.6 1.3 8.1 1.3 7.9ZM23.2 14.5C20.3 16.2 17.3 17.7 14.4 19.4C14 19.6 12.9 20 12.5 20C12.1 20 11.1 19.6 10.8 19.4C7.8 17.7 4.9 15.8 1.9 14.2C1.4 13.9 1.3 12.6 1.7 12.2C2.3 11.6 2.6 11.6 3.2 11.5C3.4 11.5 4.5 11.8 4.6 11.9C6.4 12.9 8.3 14 10.1 15C11.7 15.9 13.3 15.9 14.8 15C16.6 14 18.5 12.9 20.3 11.9C20.5 11.8 21.3 11.6 21.5 11.6C22.4 11.8 23 12.1 23.4 12.4C23.9 12.8 23.8 14.1 23.2 14.5Z"
          fill="#696270" />
      </g>
      <defs>
        <clipPath id="clip0_58_29">
          <rect width="25" height="26.7" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate">Floors</span>
  </a>
</li>
@endcan

@can('sites.floors.floor-plans')
<li
  class="menu-item {{ request()->routeIs('sites.floors.floor-plans', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
  <a class="menu-link" href="{{ route('sites.floors.floor-plans', ['site_id' => encryptParams($site_id)]) }}">

    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27" fill="none">
      <g clip-path="url(#clip0_58_29)">
        <path
          d="M23.6 16.5C23.4 16.4 23.1 16.2 22.8 16.1C23.1 15.9 23.4 15.8 23.7 15.6C25.5 14.6 25.4 12.1 23.7 11.1C23.4 10.9 23.1 10.8 22.8 10.6C23.1 10.4 23.3 10.3 23.6 10.1C24.5 9.6 25 8.9 25 7.8C25 6.8 24.5 6 23.6 5.5C20.7 3.9 17.7 2.2 14.8 0.6C14.4 0.4 13.9 0.2 13.4 0.1C13.3 0.1 13.1 0.1 13 0C12.6 0 12.3 0 11.9 0C11.9 0 11.9 0 11.8 0C11.2 0.1 10.6 0.3 10.1 0.6C7.3 2.3 4.4 3.9 1.4 5.5C0.5 6 0 6.2 0 7.2C0 8.3 0.5 9.6 1.4 10.1C1.6 10.2 1.9 10.4 2.2 10.5C1.9 10.7 1.6 10.8 1.4 11C0.5 11.6 0 11.7 0 12.7C0 13.7 0.5 15.1 1.4 15.6C1.7 15.7 1.9 15.9 2.2 16.1C1.9 16.3 1.7 16.4 1.4 16.5C0.5 17 0 17.2 0 18.2C0 19.2 0.5 20.6 1.4 21.1C4.4 22.7 7.3 24.4 10.3 26C11.8 26.8 13.3 26.8 14.8 26C15.3 25.7 15.5 25.3 15.3 24.8C15.1 24.1 14.7 24.3 14.1 24.7C13.3 25.1 12.1 25.1 11.2 24.7C8.3 23.4 5.7 21.3 2.4 19.9C2.2 19.8 1.7 18.9 1.7 18.6C1.7 18.3 1.8 18 2 17.8C2.6 17.3 3.3 16.9 4.2 17.2C4.4 17.3 4.5 17.2 4.6 17.3C6.5 18.4 8.3 19.4 10.2 20.4C11.7 21.3 13.3 21.3 14.8 20.4C16.7 19.4 18.6 18.3 20.4 17.3C20.5 17.3 21 16.9 21.1 16.9C22.1 17.1 22.6 17.4 22.9 17.9C23.1 18.2 23.5 19.1 23.1 19.3C23 19.4 22.4 19.9 22.3 19.9C21 20.6 19.9 21.2 18.6 21.9C18.1 22.2 17.9 22.4 18 22.9C18.2 23.6 18.6 23.7 19.3 23.3C20.7 22.5 22.1 21.7 23.5 21C24.4 20.5 24.9 19.7 24.9 18.7C25 17.8 24.5 17 23.6 16.5ZM1.3 7.9C1.3 7.6 1.3 7.2 1.5 7.1C4.5 5.5 8.3 3.3 11.3 1.7C12.1 1.3 12.7 1.1 13.5 1.6C16.5 3.3 20.4 5.6 23.4 7.3C23.8 7.5 23.6 8.7 23.1 8.9C20.1 10.6 16.9 12.1 14 13.8C13.6 14 12.9 14.3 12.5 14.4C12.1 14.4 11.7 14.2 11.4 14C8.4 12.3 4.7 10.5 1.8 8.9C1.5 8.6 1.3 8.1 1.3 7.9ZM23.2 14.5C20.3 16.2 17.3 17.7 14.4 19.4C14 19.6 12.9 20 12.5 20C12.1 20 11.1 19.6 10.8 19.4C7.8 17.7 4.9 15.8 1.9 14.2C1.4 13.9 1.3 12.6 1.7 12.2C2.3 11.6 2.6 11.6 3.2 11.5C3.4 11.5 4.5 11.8 4.6 11.9C6.4 12.9 8.3 14 10.1 15C11.7 15.9 13.3 15.9 14.8 15C16.6 14 18.5 12.9 20.3 11.9C20.5 11.8 21.3 11.6 21.5 11.6C22.4 11.8 23 12.1 23.4 12.4C23.9 12.8 23.8 14.1 23.2 14.5Z"
          fill="#696270" />
      </g>
      <defs>
        <clipPath id="clip0_58_29">
          <rect width="25" height="26.7" fill="white" />
        </clipPath>
      </defs>
    </svg>
    <span class="menu-title text-truncate">Floor Plans</span>
  </a>
</li>
@endcan

{{-- Units --}}
{{-- @can('sites.floors.units.show-all-units') --}}
@canany(['sites.floors.units.show-all-units', 'sites.units.show-history', 'sites.units.show-attachments'])
<li class="menu-item {{ request()->routeIs('sites.floors.units.show-all-units') ||
        request()->routeIs('sites.floors.units.index') ||
        request()->routeIs('sites.floors.units.create') ||
        request()->routeIs('sites.floors.units.edit') ||
        request()->routeIs('sites.floors.units.bifurcate.create') ||
        request()->routeIs('sites.floors.units.preview') ||
        request()->routeIs('sites.units.show-history') ||
        request()->routeIs('sites.units.show-attachments')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
      <path
        d="M21.8998 5.3C21.8998 5.1 21.7998 4.9 21.5998 4.8C19.0998 3.4 16.5998 1.9 14.0998 0.5C13.9998 0.5 13.8998 0.5 13.7998 0.5C13.6998 0.5 13.6998 0.599998 13.5998 0.599998C12.4998 1.2 11.3998 1.9 10.2998 2.5C10.6998 2.7 10.9998 2.9 11.3998 3.1C11.4998 3 11.5998 3 11.6998 2.9C12.3998 2.5 13.0998 2.1 13.7998 1.7C13.8998 1.7 13.8998 1.6 13.9998 1.7C16.0998 2.9 18.1998 4.1 20.1998 5.3C19.6998 5.6 19.2998 5.8 18.7998 6.1C18.0998 6.5 17.2998 6.9 16.5998 7.4C16.5998 7.8 16.5998 8.2 16.5998 8.6C17.8998 7.8 19.2998 7.1 20.5998 6.3C20.5998 6.3 20.6998 6.3 20.6998 6.2C20.6998 8.6 20.6998 11 20.6998 13.4C20.6998 13.5 20.6998 13.5 20.5998 13.6C18.4998 14.8 16.3998 16 14.3998 17.2C14.3998 17.2 14.3998 17.2 14.2998 17.2C14.2998 17.1 14.2998 17.1 14.2998 17.1C14.2998 17 14.2998 16.9 14.2998 16.7C13.5998 17.1 12.8998 17.5 12.1998 17.9C12.5998 18.1 12.9998 18.4 13.3998 18.6C13.5998 18.7 13.7998 18.7 13.9998 18.6C16.4998 17.2 18.8998 15.8 21.3998 14.4C21.5998 14.3 21.6998 14.1 21.6998 13.8C21.8998 10.9 21.8998 8.1 21.8998 5.3Z"
        fill="#6A6371" />
      <path
        d="M16.8999 6.49995C16.8999 6.29995 16.7999 6.09995 16.5999 5.99995C14.0999 4.59995 11.5999 3.09995 9.0999 1.69995C8.9999 1.69995 8.8999 1.69995 8.7999 1.69995C8.6999 1.69995 8.6999 1.79996 8.5999 1.79996C6.0999 3.19996 3.6999 4.59995 1.1999 5.99995C0.999902 6.09995 0.899902 6.29995 0.899902 6.59995C0.899902 9.39995 0.899902 12.2 0.899902 15C0.899902 15.2 0.999902 15.4 1.1999 15.5C3.6999 16.9 6.0999 18.3 8.5999 19.7C8.7999 19.8 8.9999 19.8 9.1999 19.7C11.6999 18.3 14.0999 16.9 16.5999 15.5C16.7999 15.4 16.8999 15.2 16.8999 14.9C16.8999 12.1 16.8999 9.29995 16.8999 6.49995ZM8.3999 18.1C8.3999 18.2 8.3999 18.2 8.3999 18.3C7.8999 18 7.4999 17.8 7.0999 17.5C5.4999 16.6 3.7999 15.6 2.1999 14.7C2.0999 14.7 2.0999 14.6 2.0999 14.5C2.0999 12.1 2.0999 9.79996 2.0999 7.39996V7.29996C2.1999 7.29996 2.1999 7.29996 2.2999 7.39996C4.2999 8.59996 6.2999 9.69996 8.2999 10.9C8.3999 11 8.4999 11 8.4999 11.2C8.3999 13.5 8.3999 15.8 8.3999 18.1ZM8.9999 9.99995C8.8999 9.99995 8.7999 10.1 8.6999 9.99995C6.5999 8.79995 4.4999 7.59996 2.4999 6.39996C3.8999 5.59996 5.1999 4.79995 6.5999 4.09995C7.2999 3.69995 7.9999 3.29996 8.6999 2.89996C8.7999 2.89996 8.7999 2.79996 8.8999 2.89996C10.9999 4.09996 13.0999 5.29995 15.0999 6.49995C14.5999 6.79995 14.1999 6.99996 13.6999 7.29996C12.2999 8.09996 10.6999 9.09995 8.9999 9.99995ZM15.6999 14.7C13.5999 15.9 11.4999 17.1 9.4999 18.3C9.4999 18.3 9.4999 18.3 9.3999 18.3C9.3999 18.2 9.3999 18.2 9.3999 18.2C9.3999 15.9 9.3999 13.5 9.3999 11.2C9.3999 11.1 9.3999 11 9.4999 11C11.5999 9.79995 13.5999 8.59995 15.6999 7.49995C15.6999 7.49995 15.7999 7.49996 15.7999 7.39996C15.7999 9.79996 15.7999 12.2 15.7999 14.6C15.7999 14.6 15.7999 14.7 15.6999 14.7Z"
        fill="#6A6371" />
    </svg>
    <span class="menu-title text-truncate" data-i18n="sales-cycle">Units</span>

  </a>
  <ul class="menu-sub">
    <li class="menu-item {{ request()->routeIs('sites.floors.units.show-all-units') ||
                request()->routeIs('sites.floors.units.index') ||
                request()->routeIs('sites.floors.units.create') ||
                request()->routeIs('sites.floors.units.edit') ||
                request()->routeIs('sites.floors.units.bifurcate.create') ||
                request()->routeIs('sites.floors.units.preview')
                    ? 'active'
                    : null }}">
      <a class="menu-link"
        href="{{ route('sites.floors.units.show-all-units', ['site_id' => encryptParams($site_id), 'floor_id' => encryptParams(1)]) }}">
        {{--
        <x-svg.dot /> --}}
        <span class="menu-title text-truncate" data-i18n="Email">Units</span>
      </a>
    </li>
    @can('sites.units.show-history')
    <li class="menu-item {{ request()->routeIs('sites.units.show-history') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.units.show-history', ['site_id' => encryptParams($site_id), 'id' => encryptParams(0)]) }}">
        {{--
        <x-svg.dot /> --}}
        <span class="menu-title text-truncate" data-i18n="Email">History</span>

      </a>
    </li>
    @endcan
    @can('sites.units.show-attachments')
    <li class="menu-item {{ request()->routeIs('sites.units.show-attachments') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.units.show-attachments', ['site_id' => encryptParams($site_id), 'id' => encryptParams(0)]) }}">
        {{--
        <x-svg.dot /> --}}
        <span class="menu-title text-truncate" data-i18n="Email">Attachments</span>
      </a>
    </li>
    @endcan

  </ul>
</li>
@endcanany

{{-- Sales Cycle --}}

@canany(['sites.floors.units.sales-plans.index', 'sites.sales_plan.create', 'sites.receipts.index',
'sites.receipts.external-stakeholder-signatures', 'sites.sales_plan_application_form.index',
'sites.sales_plan_application_form.create', 'sites.sales_plan_application_form.edit',
'sites.sales_plan_application_form.show'])
<li class="menu-item {{ request()->routeIs('sites.sales_plan_application_form.index') ||
        request()->routeIs('sites.sales_plan_application_form.create') ||
        request()->routeIs('sites.sales_plan_application_form.show') ||
        request()->routeIs('sites.floors.units.sales-plans.application-form-external-signatures') ||
        request()->routeIs('sites.sales_plan_application_form.external-stakeholder-signatures') ||
        request()->routeIs('sites.floors.units.sales-plans.index') ||
        request()->routeIs('sites.floors.units.sales-plans.create') ||
        request()->routeIs('sites.sales_plan.create') ||
        request()->routeIs('sites.floors.units.sales-plans.external-stakeholder-signatures') ||
        request()->routeIs('sites.sales_plan.generateSalesPlan') ||
        request()->routeIs('sites.floors.units.sales-plans.create-application-form') ||
        request()->routeIs('sites.receipts.index') ||
        request()->routeIs('sites.receipts.create') ||
        request()->routeIs('sites.receipts.show') ||
        request()->routeIs('sites.receipts.edit') ||
        request()->routeIs('sites.receipts.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.customers') ||
        request()->routeIs('sites.file-managements.customers.units.files.create') ||
        request()->routeIs('sites.file-managements.customers.units.files.show') ||
        request()->routeIs('sites.file-managements.file-external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.view-files') ||
        request()->routeIs('sites.floors.units.sales-plans.edit') ||
        request()->routeIs('sites.floors.units.sales-plans.updated-sales-plan') ||
        request()->routeIs('sites.sales_plan_application_form.edit') ||
        request()->routeIs('sites.sales_plan_application_form.preview-application-form') ||
        request()->routeIs('sites.file-managements.create-files', ['site_id' => encryptParams($site_id)])
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6472;
          }

          .cls-2 {
            fill: #6c6472;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <g id="Layer_2-2" data-name="Layer 2">
            <g id="Layer_1-2-2" data-name="Layer 1-2">
              <path class="cls-1" d="M18.49,5.35a9.51,9.51,0,0,1,0,10.3l.72.72a10.51,10.51,0,0,0,0-11.74Z" />
              <path class="cls-1" d="M5.35,2.51a9.51,9.51,0,0,1,10.3,0l.72-.72a10.51,10.51,0,0,0-11.74,0Z" />
              <path class="cls-1" d="M2.51,15.65a9.51,9.51,0,0,1,0-10.3l-.72-.72a10.51,10.51,0,0,0,0,11.74Z" />
              <path class="cls-1" d="M15.65,18.49a9.51,9.51,0,0,1-10.3,0l-.72.72a10.51,10.51,0,0,0,11.74,0Z" />
              <path class="cls-2"
                d="M11.35,10.53v3.28c0,.23-.06.29-.28.28H9.91c-.18,0-.26,0-.26-.24V7.16c0-.19.06-.26.26-.25h1.18c.22,0,.26.08.26.27C11.34,8.3,11.35,9.41,11.35,10.53Z" />
              <path class="cls-2"
                d="M16,10.88v2.93c0,.23-.06.29-.28.28H14.54c-.17,0-.23-.06-.23-.22v-6c0-.17.07-.22.23-.22h1.25c.19,0,.24.07.24.26C16,8.87,16,9.88,16,10.88Z" />
              <path class="cls-2"
                d="M7.32,11.37V8.94c0-.22,0-.32.29-.31H8.74c.2,0,.28,0,.28.27v4.94c0,.19,0,.26-.25.25H7.55c-.19,0-.24-.06-.24-.24C7.32,13,7.32,12.19,7.32,11.37Z" />
              <path class="cls-2"
                d="M12,11.88v-2c0-.19,0-.27.24-.26h1.22c.18,0,.24.06.24.24v4c0,.17-.06.23-.22.22H12.22c-.18,0-.24-.05-.23-.23C12,13.2,12,12.54,12,11.88Z" />
              <path class="cls-2"
                d="M5,12.21V10.68c0-.24,0-.35.31-.33s.75,0,1.13,0c.18,0,.26.05.26.25v3.25c0,.18,0,.25-.23.24H5.22C5,14.1,5,14,5,13.84Z" />
            </g>
          </g>
        </g>
      </g>
    </svg>

    <span class="menu-title text-truncate">Sales Cycle</span>
  </a>
  <ul class="menu-sub">
    @canany(['sites.floors.units.sales-plans.index', 'sites.sales_plan.create'])
    {{-- Sales Plan --}}
    <li class="menu-item {{ request()->routeIs('sites.floors.units.sales-plans.index') ||
                    request()->routeIs('sites.sales_plan.create') ||
                    request()->routeIs('sites.floors.units.sales-plans.external-stakeholder-signatures') ||
                    request()->routeIs('sites.sales_plan.generateSalesPlan') ||
                    request()->routeIs('sites.floors.units.sales-plans.edit') ||
                    request()->routeIs(
                        'sites.floors.units.sales-plans.updated-sales-plan' || request()->routeIs('sites.floors.units.sales-plans.create'),
                    )
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.floors.units.sales-plans.index', ['site_id' => encryptParams($site_id), 'floor_id' => encryptParams(0), 'unit_id' => encryptParams(0)]) }}">

        <span class="menu-title text-truncate">Payment Plan</span>
      </a>
    </li>
    @endcan
    @canany(['sites.receipts.index', 'sites.sales_plan_application_form.create',
    'sites.sales_plan_application_form.edit', 'sites.sales_plan_application_form.preview'])
    <li class="menu-item {{ request()->routeIs('sites.sales_plan_application_form.index') ||
                    request()->routeIs('sites.sales_plan_application_form.create') ||
                    request()->routeIs('sites.sales_plan_application_form.show') ||
                    request()->routeIs('sites.sales_plan_application_form.edit') ||
                    request()->routeIs('sites.sales_plan_application_form.preview-application-form') ||
                    request()->routeIs('sites.floors.units.sales-plans.application-form-external-signatures') ||
                    request()->routeIs('sites.sales_plan_application_form.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.sales_plan_application_form.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Application Form</span>
      </a>
    </li>
    @endcan
    @can('sites.receipts.index')
    <li class="menu-item {{ request()->routeIs('sites.receipts.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.receipts.create') ||
                    request()->routeIs('sites.receipts.show') ||
                    request()->routeIs('sites.receipts.edit') ||
                    request()->routeIs('sites.receipts.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.receipts.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Receipts</span>
      </a>
    </li>
    @endcan

    <!--customer file-->
    @canany(['sites.file-managements.customers', 'sites.file-managements.customers.units.files.create'])
    <li class="menu-item {{ request()->routeIs('sites.file-managements.customers', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.customers.units.files.create') ||
                    request()->routeIs('sites.file-managements.customers.units.files.show', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.customers.units.files.edit', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.file-external-stakeholder-signatures', [
                        'site_id' => encryptParams($site_id),
                    ]) ||
                    request()->routeIs('sites.file-managements.view-files', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.create-files', ['site_id' => encryptParams($site_id)])
                        ? 'active open'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.view-files', ['site_id' => encryptParams($site_id)]) }}"> <svg
          class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>

        <span class="menu-title text-truncate">Customer Files
        </span>
      </a>
      {{-- <ul class="menu-sub">
        @can('sites.file-managements.customers')
        <li class="menu-item {{ request()->routeIs('sites.file-managements.customers', ['site_id' => encryptParams($site_id)]) ||
                                request()->routeIs('sites.file-managements.customers.units.files.create')
                                    ? 'active'
                                    : null }}">
          <a class="menu-link"
            href="{{ route('sites.file-managements.customers', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">File
              Creation
            </span>
          </a>
        </li>
        @endcan

        @can('sites.file-managements.view-files')
        <li class="menu-item {{ request()->routeIs('sites.file-managements.file-external-stakeholder-signatures', [
                                    'site_id' => encryptParams($site_id),
                                ]) ||
                                request()->routeIs('sites.file-managements.view-files', ['site_id' => encryptParams($site_id)]) ||
                                request()->routeIs('sites.file-managements.customers.units.files.show', ['site_id' => encryptParams($site_id)]) ||
                                request()->routeIs('sites.file-managements.customers.units.files.edit', ['site_id' => encryptParams($site_id)])
                                    ? 'active'
                                    : null }}">
          <a class="menu-link"
            href="{{ route('sites.file-managements.view-files', ['site_id' => encryptParams($site_id)]) }}">
            <span class="menu-title text-truncate">View
              Customer Files
            </span>
          </a>
        </li>
        @endcan
      </ul> --}}
    </li>
    @endcan
  </ul>
</li>

@endcan
<!--Incentive-->
@canany(['sites.file-managements.rebate-incentive.index', 'sites.file-managements.dealer-incentive.index',
'sites.rent.all-dues-clear.index'])
<li class="menu-item {{ request()->routeIs('sites.file-managements.rebate-incentive.index', [
            'site_id' => encryptParams($site_id),
        ]) ||
        request()->routeIs('sites.rent.all-dues-clear.index') ||
        request()->routeIs('sites.rent.all-dues-clear.create') ||
        request()->routeIs('sites.rent.all-dues-clear.show') ||
        request()->routeIs('sites.rent.all-dues-clear.edit') ||
        request()->routeIs('sites.rent.all-dues-clear.update') ||
        request()->routeIs('sites.file-managements.rebate-incentive.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.rebate-incentive.create') ||
        request()->routeIs('sites.file-managements.rebate-incentive.edit') ||
        request()->routeIs('sites.file-managements.dealer-incentive.index', [
            'site_id' => encryptParams($site_id),
        ]) ||
        request()->routeIs('sites.file-managements.dealer-incentive.create') ||
        request()->routeIs('sites.file-managements.dealer-incentive.edit')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 18.79" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6b6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M19,6.46A1.69,1.69,0,0,0,17.1,4.77H15.28l.41-.43A2.41,2.41,0,0,0,15.76,1,2.62,2.62,0,0,0,11.89.77,20.13,20.13,0,0,0,9.5,3.87c-.4-.6-.77-1.15-1.15-1.69A9.63,9.63,0,0,0,7,.71,2.29,2.29,0,0,0,5.4,0,2.79,2.79,0,0,0,2.75,1.87a2.51,2.51,0,0,0,1,2.89H2A1.76,1.76,0,0,0,0,6.7c0,.8,0,1.61,0,2.41A1.59,1.59,0,0,0,.6,10.49a1,1,0,0,1,.37.92c0,1.72,0,3.45,0,5.18,0,1.57.62,2.2,2.18,2.2H16c1.5,0,2.15-.64,2.15-2.15s0-3.27,0-4.9a1.68,1.68,0,0,1,.49-1.53A1,1,0,0,0,19,9.37C19,8.4,19,7.42,19,6.46Zm-14.43-5a1.2,1.2,0,0,1,1.6.26A26.46,26.46,0,0,1,8,3.94,14.24,14.24,0,0,1,5,3.91,1.39,1.39,0,0,1,3.73,2.73C3.64,2.1,4.05,1.75,4.54,1.47ZM9.07,14.3c0,1,0,2,0,2.95,0,.43-.06.64-.56.63-2,0-4,0-6,0-.46,0-.6-.13-.59-.6,0-2,0-4.05,0-6.08,0-.41.08-.57.53-.57,2,0,4.05,0,6.08,0,.42,0,.56.11.55.55C9.05,12.22,9.07,13.26,9.07,14.3Zm.14-7.88c0,.86,0,1.73,0,2.6,0,.45-.09.63-.53.62-2.35,0-4.7,0-7,0-.41,0-.59-.14-.57-.62,0-.9,0-1.8,0-2.69,0-.47.15-.62.56-.62,1.2,0,2.41,0,3.61,0s2.24,0,3.36,0C9.11,5.69,9.24,5.88,9.21,6.42Zm3.66-4.73a1.19,1.19,0,0,1,1.62-.22,1.22,1.22,0,0,1,.81,1.28,1.38,1.38,0,0,1-1.23,1.16A23,23,0,0,1,11,4,17.26,17.26,0,0,1,12.87,1.69ZM17.26,17.3c0,.49-.18.59-.62.58q-3.06,0-6.12,0c-.45,0-.61-.1-.6-.59q0-3,0-6.09c0-.49.17-.58.61-.57,1,0,2,0,3,0s2.07,0,3.1,0c.43,0,.63.07.62.58Q17.22,14.26,17.26,17.3Zm.06-7.66c-1.14,0-2.28,0-3.43,0s-2.33,0-3.5,0c-.46,0-.6-.15-.58-.66,0-.89,0-1.79,0-2.69,0-.5.15-.59.55-.58h7c.4,0,.57.11.55.6,0,.89,0,1.79,0,2.69C18,9.54,17.76,9.65,17.32,9.64Z" />
        </g>
      </g>
    </svg>

    <span class="menu-title text-truncate">Incentive</span>
  </a>
  <ul class="menu-sub">
    @can('sites.file-managements.rebate-incentive.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.rebate-incentive.index', [
                        'site_id' => encryptParams($site_id),
                    ]) ||
                    request()->routeIs('sites.file-managements.rebate-incentive.external-stakeholder-signatures') ||
                    request()->routeIs('sites.file-managements.rebate-incentive.create') ||
                    request()->routeIs('sites.file-managements.rebate-incentive.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.rebate-incentive.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Rebate
          Incentive
        </span>
      </a>
    </li>
    @endcan

    @can('sites.file-managements.dealer-incentive.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.dealer-incentive.index', [
                        'site_id' => encryptParams($site_id),
                    ]) ||
                    request()->routeIs('sites.file-managements.dealer-incentive.create') ||
                    request()->routeIs('sites.file-managements.dealer-incentive.edit')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.dealer-incentive.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Dealer
          Incentive
        </span>
      </a>
    </li>
    @endcan
    @can('sites.rent.all-dues-clear.index')
    <li class="menu-item {{ request()->routeIs('sites.rent.all-dues-clear.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.rent.all-dues-clear.create') ||
                    request()->routeIs('sites.rent.all-dues-clear.show') ||
                    request()->routeIs('sites.rent.all-dues-clear.edit') ||
                    request()->routeIs('sites.rent.all-dues-clear.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.rent.all-dues-clear.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Rent Incentive</span>
      </a>
    </li>
    @endcan
  </ul>
</li>

@endcan

{{-- File Actions --}}
@canany(['sites.file-managements.file-buy-back.index', 'sites.file-managements.file-refund.index',
'sites.file-managements.file-cancellation.index', 'sites.file-managements.file-title-transfer.index',
'sites.sales_plan.refund.index'])
<li class="menu-item {{ request()->routeIs('sites.file-managements.file-title-transfer.index', [
            'site_id' => encryptParams($site_id),
        ]) ||
        request()->routeIs('sites.file-managements.file-buy-back.index') ||
        request()->routeIs('sites.file-managements.file-buy-back.create') ||
        request()->routeIs('sites.file-managements.file-buy-back.preview') ||
        request()->routeIs('sites.file-managements.file-buy-back.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.file-cancellation.index') ||
        request()->routeIs('sites.file-managements.file-cancellation.create') ||
        request()->routeIs('sites.file-managements.file-cancellation.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.file-cancellation.preview') ||
        request()->routeIs('sites.file-managements.file-refund.index') ||
        request()->routeIs('sites.file-managements.file-refund.create') ||
        request()->routeIs('sites.file-managements.file-refund.preview') ||
        request()->routeIs('sites.file-managements.file-refund.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.file-refund.show') ||
        request()->routeIs('sites.file-managements.file-resale.index') ||
        request()->routeIs('sites.file-managements.file-resale.create') ||
        request()->routeIs('sites.file-managements.file-resale.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.file-title-transfer.index') ||
        request()->routeIs('sites.file-managements.file-title-transfer.external-stakeholder-signatures') ||
        request()->routeIs('sites.file-managements.file-title-transfer.preview') ||
        request()->routeIs('sites.file-managements.file-title-transfer.create') ||
        request()->routeIs('sites.file-transfer-receipts.index') ||
        request()->routeIs('sites.file-transfer-receipts.create') ||
        request()->routeIs('sites.file-transfer-receipts.show') ||
        request()->routeIs('sites.file-transfer-receipts.external-stakeholder-signatures') ||
        request()->routeIs('sites.sales_plan.cancellation.index') ||
        request()->routeIs('sites.sales_plan.cancellation.show') ||
        request()->routeIs('sites.sales_plan.cancellation.create') ||
        request()->routeIs('sites.sales_plan.cancellation.external-stakeholder-signatures') ||
        request()->routeIs('sites.sales_plan.refund.index') ||
        request()->routeIs('sites.sales_plan.refund.show') ||
        request()->routeIs('sites.sales_plan.refund.create') ||
        request()->routeIs('sites.sales_plan.refund.external-stakeholder-signatures') ||
        request()->routeIs('sites.unit-shifting.index') ||
        request()->routeIs('sites.unit-shifting.create') ||
        request()->routeIs('sites.unit-shifting.preview') ||
        request()->routeIs('sites.unit-shifting.external-stakeholder-signatures')
            ? 'active open'
            : null }}">

  <a class="menu-link menu-toggle" href="#">

    <img class="menu-icon" src="{{ asset('assets/sitebar-icon/file-management.svg') }}" />

    <span class="menu-title text-truncate">File Actions</span>
  </a>
  <ul class="menu-sub">
    @can('sites.sales_plan.cancellation.index')
    <li class="menu-item {{ request()->routeIs('sites.sales_plan.cancellation.index', [
                        'site_id' => encryptParams($site_id),
                    ]) ||
                    request()->routeIs('sites.sales_plan.cancellation.create') ||
                    request()->routeIs('sites.sales_plan.cancellation.show') ||
                    request()->routeIs('sites.sales_plan.cancellation.external-stakeholder-signatures', [
                        'site_id' => encryptParams($site_id),
                    ])
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.sales_plan.cancellation.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Payment Plan
          Cancellation</span>
      </a>
    </li>
    @endcan
    @can('sites.sales_plan.refund.index')
    <li class="menu-item {{ request()->routeIs('sites.sales_plan.refund.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.sales_plan.refund.create') ||
                    request()->routeIs('sites.sales_plan.refund.show') ||
                    request()->routeIs('sites.sales_plan.refund.external-stakeholder-signatures', ['site_id' => encryptParams($site_id)])
                        ? 'active'
                        : null }}">

      <a class="menu-link" href="{{ route('sites.sales_plan.refund.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Payment Plan Refund</span>
      </a>
    </li>
    @endcan
    @can('sites.file-managements.file-buy-back.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.file-buy-back.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.file-buy-back.create') ||
                    request()->routeIs('sites.file-managements.file-buy-back.preview') ||
                    request()->routeIs('sites.file-managements.file-buy-back.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.file-buy-back.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">File Buy Back</span>
      </a>
    </li>
    @endcan
    @can('sites.file-managements.file-cancellation.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.file-cancellation.index', [
                        'site_id' => encryptParams($site_id),
                    ]) ||
                    request()->routeIs('sites.file-managements.file-cancellation.create') ||
                    request()->routeIs('sites.file-managements.file-cancellation.preview') ||
                    request()->routeIs('sites.file-managements.file-cancellation.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.file-cancellation.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">File
          Cancellation</span>
      </a>
    </li>
    @endcan

    @can('sites.unit-shifting.index')
    <li class="menu-item {{ request()->routeIs('sites.unit-shifting.index') ||
                    request()->routeIs('sites.unit-shifting.create') ||
                    request()->routeIs('sites.unit-shifting.preview') ||
                    request()->routeIs('sites.unit-shifting.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">

      <a class="menu-link" href="{{ route('sites.unit-shifting.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Unit Shifting</span>
      </a>
    </li>
    @endcan
    @can('sites.file-managements.file-refund.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.file-refund.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.file-refund.create') ||
                    request()->routeIs('sites.file-managements.file-refund.preview') ||
                    request()->routeIs('sites.file-managements.file-refund.show') ||
                    request()->routeIs('sites.file-managements.file-refund.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.file-refund.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">File Refund</span>
      </a>
    </li>
    @endcan
    @can('sites.file-managements.file-resale.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.file-resale.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-managements.file-resale.create') ||
                    request()->routeIs('sites.file-managements.file-resale.preview') ||
                    request()->routeIs('sites.file-managements.file-resale.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.file-resale.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">File Resale</span>
      </a>

    </li>
    @endcan
    @can('sites.file-managements.file-title-transfer.index')
    <li class="menu-item {{ request()->routeIs('sites.file-managements.file-title-transfer.index', [
                        'site_id' => encryptParams($site_id),
                    ]) ||
                    request()->routeIs('sites.file-managements.file-title-transfer.preview') ||
                    request()->routeIs('sites.file-managements.file-title-transfer.create') ||
                    request()->routeIs('sites.file-managements.file-title-transfer.external-stakeholder-signatures')
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-managements.file-title-transfer.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">File Title
          Transfer</span>
      </a>
    </li>
    @endcan
    @can('sites.file-transfer-receipts.index')
    <li class="menu-item {{ request()->routeIs('sites.file-transfer-receipts.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-transfer-receipts.create', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-transfer-receipts.show', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.file-transfer-receipts.external-stakeholder-signatures', [
                        'site_id' => encryptParams($site_id),
                    ])
                        ? 'active'
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.file-transfer-receipts.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">File Transfer
          Receipts</span>
      </a>
    </li>
    @endcan
  </ul>
</li>

@endcan
{{-- Investor cycle --}}
@canany(['sites.investors-deals.index', 'sites.investors-deals.edit', 'sites.investors-deals.create',
'sites.file-transfer-receipts.index'])
<li class="menu-item
        {{ request()->routeIs('sites.investors-deals.index', ['site_id' => encryptParams($site_id)]) ||
        request()->routeIs('sites.investors-deals.create') ||
        request()->routeIs('sites.investors-deals.edit') ||
        request()->routeIs('sites.investors-deals.preview') ||
        request()->routeIs('sites.investor-deals-receipts.index', ['site_id' => encryptParams($site_id)]) ||
        request()->routeIs('sites.investor-deals-receipts.create', ['site_id' => encryptParams($site_id)])
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 19.21" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6b6371;
          }

          .cls-2 {
            fill: #6c6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M15.65,8.94a3.09,3.09,0,0,0-2-2.53A3.91,3.91,0,0,0,8.27.78,3.82,3.82,0,0,0,6.79,3.13a3.87,3.87,0,0,0,.83,3.28l-.11,0A3,3,0,0,0,5.59,8.87a13.87,13.87,0,0,0,0,2,.76.76,0,0,0,.78.78.77.77,0,0,0,.78-.79V9.47A1.57,1.57,0,0,1,8.77,7.8h3.7a1.56,1.56,0,0,1,1.65,1.64c0,.51,0,1,0,1.51a.78.78,0,0,0,1.54.11A11.54,11.54,0,0,0,15.65,8.94ZM10.41,6.15a2.34,2.34,0,0,1,0-4.68,2.37,2.37,0,0,1,2.32,2.38A2.36,2.36,0,0,1,10.41,6.15Z" />
          <path class="cls-2"
            d="M0,13.49a3.47,3.47,0,0,1,.7-1.31A5.56,5.56,0,0,1,2,11.08a.62.62,0,0,1,.86.19.62.62,0,0,1-.2.86,4.33,4.33,0,0,0-1.14,1,1,1,0,0,0-.27.91,1.12,1.12,0,0,0,.42.56,6,6,0,0,0,2,1,19.71,19.71,0,0,0,4,.87l1,.13a3.8,3.8,0,0,1-.29-.34.63.63,0,0,1,.06-.87.61.61,0,0,1,.86.05c.44.48.86,1,1.28,1.47a.56.56,0,0,1,0,.78c-.48.48-1,.95-1.47,1.4A.59.59,0,0,1,8.14,19a.63.63,0,0,1,0-.84l.33-.33c-.4-.05-.78-.09-1.16-.15a18.17,18.17,0,0,1-5.27-1.39,4.56,4.56,0,0,1-1.45-1,2.11,2.11,0,0,1-.57-1,.05.05,0,0,0,0-.06Z" />
          <path class="cls-2"
            d="M21,13.56A2,2,0,0,1,20.45,15a5.22,5.22,0,0,1-1.91,1.31,16.68,16.68,0,0,1-3.16,1,.61.61,0,0,1-.76-.46.62.62,0,0,1,.46-.73,19.72,19.72,0,0,0,2.51-.78,6.13,6.13,0,0,0,1.66-.92,1,1,0,0,0,.11-1.7,4,4,0,0,0-.66-.58.62.62,0,1,1,.69-1A3.62,3.62,0,0,1,20.93,13a1.33,1.33,0,0,1,.06.3A1,1,0,0,1,21,13.56Z" />
        </g>
      </g>
    </svg>

    <span class="menu-title text-truncate">Investor Cycle</span>
  </a>
  <ul class="menu-sub">
    @can('sites.investors-deals.index')
    <li
      class="menu-item {{ request()->routeIs('sites.investors-deals.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.investors-deals.create') ||
                    request()->routeIs('sites.investors-deals.edit') ||
                    request()->routeIs('sites.investors-deals.preview')
                        ? 'active'
                        : null }} || request()->routeIs('sites.investors-deals.create', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}  || request()->routeIs('sites.investors-deals.edit', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link" href="{{ route('sites.investors-deals.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Investors Deals</span>
      </a>
    </li>
    @endcan
    @can('sites.investor-deals-receipts.index')
    <li
      class="menu-item {{ request()->routeIs('sites.investor-deals-receipts.index', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.investor-deals-receipts.create', ['site_id' => encryptParams($site_id)])
                        ? 'active'
                        : null }}
                             || request()->routeIs('sites.investor-deals-receipts.edit', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.investor-deals-receipts.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate">Deals
          Receipts</span>
      </a>
    </li>
    @endcan
  </ul>
</li>
@endcan

{{-- Accounts Menu --}}
@canany(['sites.accounts.recovery.inventory-aging', 'sites.accounts.charts-of-accounts.index',
'sites.accounts.journal-entry.index', 'sites.accounts.general-ledger.index', 'sites.settings.journal-vouchers.index',
'sites.accounts.trail-balance.index', 'sites.accounts.profit-and-loss.index', 'sites.accounts.balance-sheet.index',
'sites.payment-voucher.index', 'sites.accounts.accounting-period.index', 'sites.accounts.accounting-period.create',
'sites.accounts.accounting-period.edit', 'sites.accounts.accounting-period.preview', 'sites.reports.recovery'])
<li class="menu-item {{ request()->routeIs('sites.accounts.charts-of-accounts.index', ['site_id' => encryptParams($site_id)]) ||
        request()->routeIs('sites.settings.journal-vouchers.*') ||
        request()->routeIs('sites.settings.journal-vouchers.show') ||
        request()->routeIs('sites.settings.journal-vouchers.create') ||
        request()->routeIs('sites.settings.journal-vouchers.edit') ||
        request()->routeIs('sites.accounts.journal-entry.*') ||
        request()->routeIs('sites.settings.manual-entries.*') ||
        request()->routeIs('sites.accounts.trail-balance.*') ||
        request()->routeIs('sites.accounts.profit-and-loss.*') ||
        request()->routeIs('sites.accounts.general-ledger.*') ||
        request()->routeIs('sites.accounts.balance-sheet.*') ||
        request()->routeIs('sites.payment-voucher.*') ||
        request()->routeIs('sites.payment-voucher.create') ||
        request()->routeIs('sites.payment-voucher.edit') ||
        request()->routeIs('sites.accounts.accounting-period.*') ||
        request()->routeIs('sites.accounts.accounting-period.preview') ||
        request()->routeIs('sites.accounts.accounting-period.edit') ||
        request()->routeIs('sites.accounts.accounting-period.create') ||
        request()->routeIs('sites.reports.recovery')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="22" viewBox="0 0 17 22" fill="none" class="menu-icon">
      <path
        d="M16.3 1.7C16.3 0.4 15.8 0 14.5 0C10.4 0 6.20004 0 2.10004 0C0.800044 0 0.300049 0.4 0.300049 1.8C0.300049 4.8 0.300049 7.8 0.300049 10.9C0.300049 14 0.300049 17 0.300049 20.1C0.300049 21.3 0.800046 21.8 2.00005 21.8C6.20005 21.8 10.3 21.8 14.5 21.8C15.8 21.8 16.3 21.3 16.3 20C16.3 13.9 16.3 7.8 16.3 1.7ZM3.40005 12.3C5.30005 12.3 5.30005 12.3 5.30005 14.1C5.30005 15.9 5.30005 15.9 3.40005 15.9C1.40005 15.9 1.40005 16.1 1.40005 14C1.50005 12.3 1.50005 12.3 3.40005 12.3ZM1.50005 9.5C1.50005 7.7 1.50005 7.7 3.40005 7.7C5.30005 7.7 5.30005 7.7 5.30005 9.6C5.30005 11.3 5.30005 11.3 3.40005 11.3C1.50005 11.4 1.50005 11.4 1.50005 9.5ZM3.40005 20.6C1.60005 20.6 1.50005 21 1.50005 18.7C1.50005 16.9 1.50005 16.9 3.30005 16.9C5.30005 16.9 5.30005 16.7 5.30005 18.8C5.30005 20.9 5.20005 20.6 3.40005 20.6ZM2.40005 6.8C1.70005 6.8 1.40005 6.5 1.40005 5.6C1.40005 4.4 1.40005 3.3 1.40005 2.1C1.40005 1.3 1.70005 1 2.30005 1C6.30005 1 10.3 1 14.2 1C14.8 1 15.1 1.3 15.1 2.1C15.1 3.3 15.1 4.5 15.1 5.7C15.1 6.5 14.8 6.8 14.2 6.8C12.2 6.8 10.2 6.8 8.20004 6.8C6.40004 6.8 4.40005 6.7 2.40005 6.8ZM13.2 12.3C15.1 12.3 15.2 12 15.2 14.2C15.2 15.9 15.2 15.9 13.3 15.9C11.4 15.9 11.4 16.1 11.4 14.1C11.4 12.3 11.4 12.3 13.2 12.3ZM11.4 9.5C11.4 7.8 11.4 7.8 13.3 7.8C15.2 7.8 15.2 7.8 15.2 9.6C15.2 11.3 15.2 11.4 13.4 11.3C11.4 11.3 11.3 11.6 11.4 9.5ZM10.3 9.6C10.3 11.3 10.3 11.3 8.30005 11.3C6.30005 11.3 6.30005 11.5 6.30005 9.5C6.30005 7.7 6.30004 7.7 8.20004 7.7C10.5 7.7 10.3 7.7 10.3 9.6ZM8.40005 20.6C6.40005 20.6 6.40005 20.9 6.40005 18.7C6.40005 16.9 6.40005 16.9 8.30005 16.9C10.5 16.9 10.3 16.8 10.3 18.9C10.3 20.8 10.3 20.6 8.40005 20.6ZM8.30005 15.9C6.40005 15.9 6.40005 15.9 6.40005 14.1C6.40005 12.1 6.40005 12.3 8.40005 12.3H8.50005C10.4 12.3 10.4 12.3 10.4 14C10.3 16.1 10.4 15.9 8.30005 15.9ZM13.2 20.6C11.4 20.6 11.3 20.9 11.3 18.8C11.3 16.7 11.3 16.9 13.3 16.9C15.2 16.9 15.2 16.9 15.2 18.7C15.2 21 15 20.5 13.2 20.6Z"
        fill="#656565" />
    </svg>
    <span class="menu-title text-truncate">Accounts</span>
  </a>
  <ul class="menu-sub">

    @can('sites.accounts.charts-of-accounts.index')
    <li
      class="menu-item {{ request()->routeIs('sites.accounts.charts-of-accounts.index', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.accounts.charts-of-accounts.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Charts of Accounts</span>
      </a>
    </li>
    @endcan
    @can('sites.settings.journal-vouchers.index')
    <li class="menu-item {{ request()->routeIs('sites.settings.journal-vouchers.*') ||
                    request()->routeIs('sites.settings.journal-vouchers.show') ||
                    request()->routeIs('sites.settings.journal-vouchers.create') ||
                    request()->routeIs('sites.settings.journal-vouchers.edit')
                        ? 'active '
                        : null }}">
      <a class="menu-link"
        href="{{ route('sites.settings.journal-vouchers.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate">Journal Vouchers</span>
      </a>
    </li>
    @endcan
    <li class="menu-item {{ request()->routeIs('sites.accounts.journal-entry.index') ||
                request()->routeIs('sites.settings.manual-entries.*')
                    ? 'active open'
                    : null }}">
      <a class="menu-link menu-toggle" href="#">

        <span class="menu-title text-truncate">Accounting Entries</span>
      </a>
      <ul class="menu-sub">
        @can('sites.accounts.journal-entry.index')
        <li class="menu-item {{ request()->routeIs('sites.accounts.journal-entry.index') ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.accounts.journal-entry.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Journal Entries</span>
          </a>
        </li>
        @endcan
        @can('sites.settings.manual-entries.index')
        <li
          class="menu-item {{ request()->routeIs('sites.settings.manual-entries.*') || request()->routeIs('sites.settings.manual-entries.show') || request()->routeIs('sites.settings.manual-entries.create') ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.settings.manual-entries.index', ['site_id' => encryptParams($site_id)]) }}">

            <span class="menu-title text-truncate">Manual
              Entries</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    @can('sites.payment-voucher.index')
    <li class="menu-item {{ request()->routeIs('sites.payment-voucher.*', ['site_id' => encryptParams($site_id)]) ||
                    request()->routeIs('sites.payment-voucher.create') ||
                    request()->routeIs('sites.payment-voucher.edit') ||
                    request()->routeIs('sites.payment-voucher.external-stakeholder-signatures') ||
                    request()->routeIs('sites.payment-voucher.show')
                        ? 'active'
                        : null }}">
      <a class="menu-link" href="{{ route('sites.payment-voucher.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Payment History</span>
      </a>
    </li>
    @endcan
    {{-- General Ledger --}}
    @can('sites.accounts.general-ledger.index')
    <li
      class="menu-item {{ request()->routeIs('sites.accounts.general-ledger.index') || request()->routeIs('sites.accounts.general-ledger.filter-trial-blance') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.accounts.general-ledger.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">General Ledger</span>
      </a>
    </li>
    @endcan
    {{-- Year Closing --}}

    {{-- <li class="menu-item {{ request()->routeIs('sites.accounts.accounting-period.edit') ||
                request()->routeIs('sites.accounts.accounting-period.preview') ||
                request()->routeIs('sites.accounts.accounting-period.create') ||
                request()->routeIs('sites.accounts.accounting-period.index')
                    ? 'active open'
                    : null }}">
      <a class="menu-link menu-toggle" href="#">
        <span class="menu-title text-truncate">Year Closing</span>
      </a>
      <ul class="menu-sub"> --}}
        {{-- Accounting Period --}}
        {{-- @can('sites.accounts.accounting-period.index')
        <li class="menu-item ">
          <a class="menu-link"
            href="{{ route('sites.accounts.accounting-period.index', ['site_id' => encryptParams($site_id)]) }}">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true" role="img" tag="i"
              class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
              viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2"></circle>
            </svg>
            <span class="menu-title text-truncate" data-i18n="Email">Accounting Period</span>
          </a>
        </li>
        @endcan
      </ul>
    </li> --}}
    <li class="menu-item {{ request()->routeIs('sites.reports.recovery', ['site_id' => encryptParams($site_id)]) ||
                request()->routeIs('sites.accounts.trail-balance.index', ['site_id' => encryptParams($site_id)]) ||
                request()->routeIs('sites.accounts.profit-and-loss.index', ['site_id' => encryptParams($site_id)]) ||
                request()->routeIs('sites.accounts.balance-sheet.index', ['site_id' => encryptParams($site_id)])
                    ? 'active open'
                    : null }}">
      <a class="menu-link menu-toggle" href="#">

        <span class="menu-title text-truncate">Reports</span>
      </a>
      <ul class="menu-sub">
        {{-- Trial Balance --}}
        @can('sites.accounts.trail-balance.index')
        <li
          class="menu-item {{ request()->routeIs('sites.accounts.trail-balance.index', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.accounts.trail-balance.index', ['site_id' => encryptParams($site_id)]) }}">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true" role="img" tag="i"
              class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
              viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2"></circle>
            </svg>
            <span class="menu-title text-truncate">Trial Balance</span>
          </a>
        </li>
        @endcan
        {{-- Profit and Loss --}}
        @can('sites.accounts.profit-and-loss.index')
        <li
          class="menu-item {{ request()->routeIs('sites.accounts.profit-and-loss.index', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.accounts.profit-and-loss.index', ['site_id' => encryptParams($site_id)]) }}">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true" role="img" tag="i"
              class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
              viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2"></circle>
            </svg>
            <span class="menu-title text-truncate">Profit & Loss</span>
          </a>
        </li>
        @endcan
        {{-- Balance Sheet --}}
        @can('sites.accounts.balance-sheet.index')
        <li
          class="menu-item {{ request()->routeIs('sites.accounts.balance-sheet.index', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
          <a class="menu-link"
            href="{{ route('sites.accounts.balance-sheet.index', ['site_id' => encryptParams($site_id)]) }}">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true" role="img" tag="i"
              class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
              viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2"></circle>
            </svg>
            <span class="menu-title text-truncate">Balance Sheet</span>
          </a>
        </li>
        @endcan

        {{-- Recovery Report --}}
        @can('sites.reports.recovery')
        <li class="menu-item {{ request()->routeIs('sites.reports.recovery') ? 'active' : null }}">
          <a class="menu-link" href="{{ route('sites.reports.recovery', ['site_id' => encryptParams($site_id)]) }}">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true" role="img" tag="i"
              class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
              viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2"></circle>
            </svg>
            <span class="menu-title text-truncate" data-i18n="Email">Recovery Report</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>
  </ul>
</li>
@endcanany

{{-- Account Recovery --}}
@canany(['sites.accounts.recovery.salesPlan', 'sites.accounts.recovery.calender',
'sites.accounts.recovery.inventory-aging', 'sites.recovery.stakeholder-wise'])
<li class="menu-item {{ request()->routeIs('sites.accounts.recovery.salesPlan') ||
        request()->routeIs('sites.accounts.recovery.calender') ||
        request()->routeIs('sites.accounts.recovery.inventory-aging') ||
        request()->routeIs('sites.recovery.stakeholder-wise')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="javascript:void(0);">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="menu-icon">
      <path
        d="M8.9001 0.400024C9.1001 0.500024 9.3001 0.500023 9.5001 0.500023C10.9001 0.700023 12.2001 1.30002 13.3001 2.20002C13.7001 2.50002 14.1001 2.90002 14.4001 3.20002C14.4001 3.20002 14.4001 3.20002 14.5001 3.30002C14.5001 3.00002 14.5001 2.80002 14.5001 2.50002C14.5001 2.40002 14.5001 2.40002 14.6001 2.40002C14.9001 2.40002 15.1001 2.40002 15.4001 2.40002C15.5001 2.40002 15.5001 2.40002 15.5001 2.50002C15.5001 3.40002 15.5001 4.30002 15.5001 5.20002C15.5001 5.30002 15.5001 5.30002 15.4001 5.30002C14.5001 5.30002 13.6001 5.30002 12.7001 5.30002C12.6001 5.30002 12.6001 5.30002 12.6001 5.20002C12.6001 4.90002 12.6001 4.70002 12.6001 4.40002C12.6001 4.30002 12.6001 4.30002 12.7001 4.30002C13.1001 4.30002 13.5001 4.30002 13.8001 4.30002C13.9001 4.30002 13.9001 4.30002 14.0001 4.30002C13.7001 3.90002 13.4001 3.60002 13.1001 3.30002C12.0001 2.30002 10.7001 1.70002 9.2001 1.40002C8.3001 1.30002 7.4001 1.30002 6.5001 1.50002C6.4001 1.50002 6.4001 1.50002 6.3001 1.40002C6.2001 1.20002 6.2001 0.900024 6.1001 0.700024C6.1001 0.600024 6.1001 0.600021 6.2001 0.600021C6.6001 0.500021 7.0001 0.400024 7.4001 0.400024H7.5001C7.6001 0.400024 7.7001 0.400024 7.7001 0.400024C7.8001 0.400024 7.8001 0.400024 7.9001 0.400024C8.1001 0.400024 8.4001 0.400024 8.6001 0.400024C8.7001 0.400024 8.8001 0.400024 8.9001 0.400024C8.8001 0.400024 8.8001 0.400024 8.9001 0.400024Z"
        fill="#64606F" />
      <path
        d="M16.5001 9.29998C16.4001 9.49998 16.4001 9.69998 16.4001 9.79998C16.1001 11.7 15.2001 13.3 13.8001 14.6C13.7001 14.7 13.7001 14.7 13.6001 14.8C13.9001 14.8 14.1001 14.8 14.4001 14.8C14.5001 14.8 14.5001 14.8 14.5001 14.9C14.5001 15.2 14.5001 15.4 14.5001 15.7C14.5001 15.8 14.5001 15.8 14.4001 15.8C13.5001 15.8 12.6001 15.8 11.7001 15.8C11.6001 15.8 11.6001 15.8 11.6001 15.7C11.6001 14.8 11.6001 14 11.6001 13.1C11.6001 13 11.6001 13 11.7001 13C12.0001 13 12.2001 13 12.5001 13C12.6001 13 12.6001 13 12.6001 13.1C12.6001 13.5 12.6001 13.9 12.6001 14.4C12.8001 14.3 12.9001 14.1 13.1001 14C14.4001 12.8 15.2001 11.3 15.4001 9.59998C15.5001 8.69998 15.5001 7.79998 15.3001 6.89998C15.3001 6.79998 15.3001 6.79998 15.4001 6.79998C15.6001 6.69998 15.9001 6.69998 16.1001 6.59998C16.2001 6.59998 16.2001 6.59998 16.2001 6.69998C16.3001 7.09998 16.4001 7.49998 16.4001 7.89998V7.99998C16.4001 8.09998 16.4001 8.19998 16.4001 8.29998C16.4001 8.39998 16.4001 8.49998 16.4001 8.49998C16.4001 8.69998 16.4001 8.89998 16.4001 8.99998C16.4001 8.99998 16.4001 8.99998 16.4001 9.09998C16.5001 9.19998 16.5001 9.29998 16.5001 9.29998Z"
        fill="#64606F" />
      <path d="M16.5 8.60002C16.4 8.50002 16.4 8.40002 16.5 8.40002C16.5 8.40002 16.5 8.50002 16.5 8.60002Z"
        fill="#191919" />
      <path
        d="M8.00005 0.400024C7.90005 0.400024 7.90005 0.500024 7.80005 0.400024C7.90005 0.400024 8.00005 0.400024 8.00005 0.400024Z"
        fill="#2C2B2B" />
      <path d="M8.80006 0.400024C8.80006 0.500024 8.70006 0.400024 8.80006 0.400024Z" fill="#6A6767" />
      <path
        d="M2 14.1C2 14.4 2 14.6 2 14.9C2 14.9 2 15 1.9 15C1.6 15 1.4 15 1.1 15C1 15 1 14.9 1 14.9C1 14 1 13.1 1 12.2C1 12.1 1 12.1 1.1 12.1C2 12.1 2.8 12.1 3.7 12.1C3.8 12.1 3.8 12.1 3.8 12.2C3.8 12.4 3.8 12.7 3.8 12.9C3.8 13 3.8 13 3.6 13C3.2 13 2.8 13 2.4 13C2.4 13.1 2.4 13.1 2.4 13.1C3.6 14.6 5.1 15.5 7 15.8C8.1 16 9 15.9 9.9 15.7C10 15.7 10 15.7 10.1 15.8C10.2 16 10.2 16.3 10.3 16.5C10.3 16.6 10.3 16.6 10.2 16.6C9.6 16.7 9.1 16.8 8.5 16.8C6 16.9 3.8 16 2 14.1Z"
        fill="#64606F" />
      <path
        d="M2.9 2.5C2.6 2.5 2.3 2.5 2.1 2.5C2 2.5 2 2.5 2 2.4C2 2.1 2 1.9 2 1.6C2 1.5 2 1.5 2.1 1.5C3 1.5 3.9 1.5 4.8 1.5C4.9 1.5 4.9 1.5 4.9 1.6C4.9 2.5 4.9 3.3 4.9 4.2C4.9 4.3 4.9 4.3 4.8 4.3C4.6 4.3 4.3 4.3 4.1 4.3C4 4.3 4 4.3 4 4.2C4 3.8 4 3.4 4 2.9C3.8 3 3.7 3.2 3.5 3.3C2.3 4.4 1.5 5.8 1.2 7.5C1 8.5 1.1 9.4 1.3 10.4C1.3 10.5 1.3 10.5 1.2 10.6C1 10.7 0.7 10.7 0.5 10.8C0.4 10.8 0.4 10.8 0.4 10.7C0 9.8 0 8.9 0 8C0.1 6.5 0.6 5.2 1.5 4C1.7 3.7 1.9 3.5 2.1 3.2C2.4 2.9 2.6 2.7 2.9 2.5Z"
        fill="#64606F" />
    </svg>
    <span class="menu-title text-truncate" data-i18n="Recovery">Recovery</span>
  </a>
  <ul class="menu-sub">

    {{-- @can('sites.accounts.recovery.dashboard')
    <li
      class="menu-item {{ request()->routeIs('sites.accounts.recovery.dashboard', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.accounts.recovery.dashboard', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Sales Plans">Dashboard
        </span>
      </a>
    </li>
    @endcan --}}
    @can('sites.recovery.stakeholder-wise')
    <li
      class="menu-item {{ request()->routeIs('sites.recovery.stakeholder-wise', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.recovery.stakeholder-wise', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Sales Plans">Dashboard
        </span>
      </a>
    </li>
    @endcan
    @can('sites.accounts.recovery.salesPlan')
    <li
      class="menu-item {{ request()->routeIs('sites.accounts.recovery.salesPlan', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.accounts.recovery.salesPlan', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Sales Plans">Payment Plan
        </span>
      </a>
    </li>
    @endcan
    @can('sites.accounts.recovery.calender')
    <li
      class="menu-item {{ request()->routeIs('sites.accounts.recovery.calender', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.accounts.recovery.calender', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Calender">Calendar</span>
      </a>
    </li>
    @endcan
    @can('sites.accounts.recovery.inventory-aging')
    <li
      class="menu-item {{ request()->routeIs('sites.accounts.recovery.inventory-aging', ['site_id' => encryptParams($site_id)]) ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.accounts.recovery.inventory-aging', ['site_id' => encryptParams($site_id)]) }}">
        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          aria-hidden="true" role="img" tag="i"
          class="v-icon notranslate v-theme--light menu-item-icon iconify iconify--tabler" width="1em" height="1em"
          viewBox="0 0 24 24" style="font-size: 10px; height: 10px; width: 10px;">
          <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></circle>
        </svg>
        <span class="menu-title text-truncate" data-i18n="Calender"> Aging Report</span>
      </a>
    </li>
    @endcan

  </ul>
</li>
@endcanany

{{-- Procurement --}}
{{-- @canany(['sites.procurment.items.index', 'sites.procurment.rack-management.index',
'sites.procurment.warehouse.index', 'sites.procurment.purchase-requisition.index',
'sites.procurment.request-for-proposal.index', 'sites.procurment.good-received-note.index',
'sites.procurment.invoice.index', 'sites.procurment.purchase-order.index', 'sites.procurment.material-request.index',
'sites.procurment.material-issuance.index', 'sites.procurment.manual-stock-update.index'])
<li class="menu-header">
  <span data-i18n="Others">Procurement</span>
</li>
@endcanany --}}

{{-- Items --}}
{{-- @canany(['sites.procurment.items.index', 'sites.procurment.item-units.index'])
<li class="menu-item {{ request()->routeIs('sites.procurment.items.*') ||
        request()->routeIs('sites.procurment.item-units.*') ||
        request()->routeIs('sites.procurment.cost-center.*')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate" data-i18n="sales-cycle">Items</span>

  </a>
  <ul class="menu-sub">

    @can('sites.procurment.items.index')
    <li
      class="menu-item {{ request()->routeIs('sites.procurment.items.*') && !request()->routeIs('sites.procurment.unassigned-items.*') ? 'active open' : null }}">
      <a class="menu-link" href="{{ route('sites.procurment.items.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Items">Items</span>
      </a>
    </li>
    @endcan
    @can('sites.procurment.item-ledger.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.item-ledger.*') ? 'active open' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.item-ledger.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Item Ledger">Item Ledger</span>
      </a>
    </li>
    @endcan
    @can('sites.procurment.item-units.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.item-units.*') ? 'active open' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.item-units.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate" data-i18n="Items">Item Units</span>
      </a>
    </li>
    @endcan
    @can('sites.procurment.cost-center.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.cost-center.*') ? 'active open' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.cost-center.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate" data-i18n="Cost Center">Cost Centers</span>
      </a>
    </li>
    @endcan

  </ul>
</li>
@endcanany --}}

{{-- Rack management --}}
{{-- Items --}}
{{-- @canany(['sites.procurment.warehouse.index', 'sites.procurment.rack-management.index',
'sites.procurment.unassigned-items.index'])
<li class="menu-item {{ request()->routeIs('sites.procurment.warehouse.*') ||
        request()->routeIs('sites.procurment.rack-management.*') ||
        request()->routeIs('sites.procurment.unassigned-items.*')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate" data-i18n="sales-cycle">Rack Management</span>

  </a>
  <ul class="menu-sub">
    @can('sites.procurment.warehouse.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.warehouse.*') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.warehouse.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Tax">Warehouses</span>
      </a>
    </li>
    @endcan
    @can('sites.procurment.rack-management.index')
    <li
      class="menu-item {{ request()->routeIs('sites.procurment.rack-management.*') && !request()->routeIs('sites.procurment.rack-management.rack-assignment') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.rack-management.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Tax">Racks</span>
      </a>
    </li>
    @endcan
    @can('sites.procurment.unassigned-items.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.unassigned-items.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.unassigned-items.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate" data-i18n="Items">Unassigned Items</span>
      </a>
    </li>
    @endcan

  </ul>
</li>
@endcanany --}}

{{-- Stock --}}
{{-- @canany(['sites.procurment.manual-stock-update.index'])
<li class="menu-item {{ request()->routeIs('sites.procurment.manual-stock-update.*') ? 'active open' : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate" data-i18n="sales-cycle">Stock Details</span>

  </a>
  <ul class="menu-sub">
    @can('sites.procurment.manual-stock-update.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.manual-stock-update.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.manual-stock-update.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Items">Manual Stock Update</span>
      </a>
    </li>
    @endcan

  </ul>
</li>
@endcanany --}}

{{-- Procurement Request Cycle --}}
{{-- @canany(['sites.procurment.material-request.index', 'sites.procurment.material-issuance.index',
'sites.procurment.material-consumption.index', 'sites.procurment.material-return.index'])
<li class="menu-item {{ request()->routeIs('sites.procurment.material-request.*') ||
        request()->routeIs('sites.procurment.material-issuance.*') ||
        request()->routeIs('sites.procurment.material-consumption.*') ||
        request()->routeIs('sites.procurment.material-return.*')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate" data-i18n="sales-cycle">Request Cycle</span>

  </a>
  <ul class="menu-sub">

    @can('sites.procurment.material-request.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.material-request.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.material-request.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Material Request">Material Request</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.material-issuance.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.material-issuance.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.material-issuance.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Material Issuance">Material Issuance</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.material-consumption.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.material-consumption.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.material-consumption.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Material Issuance">Material Consumption</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.material-return.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.material-return.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.material-return.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Material Issuance">Material Return</span>
      </a>
    </li>
    @endcan

  </ul>
</li>
@endcanany --}}

{{-- @canany(['sites.procurment.contractors.contracts.index', 'sites.procurment.contractors.locations.index'])
<li class="menu-item {{ request()->routeIs('sites.procurment.contractors.contracts.*') ||
        request()->routeIs('sites.procurment.contractors.locations.*')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate">Contractors</span>
  </a>
  <ul class="menu-sub">
    @can('sites.procurment.contractors.contracts.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.contractors.contracts.index') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.contractors.contracts.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate">Contracts</span>
      </a>
    </li>
    @endcan
    @can('sites.procurment.contractors.locations.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.contractors.locations.*') ? 'active' : null }} ">
      <a class="menu-link"
        href="{{ route('sites.procurment.contractors.locations.index', ['site_id' => encryptParams($site_id)]) }}">
        <span class="menu-title text-truncate" data-i18n="Purchase Request">Locations</span>
      </a>
    </li>
    @endcan
  </ul>
</li>
@endcanany --}}

{{-- PROCUREMENT PURCHASE CYCLE --}}
{{-- @canany(['sites.procurment.purchase-requisition.index', 'sites.procurment.request-for-proposal.index',
'sites.procurment.purchase-order.index', 'sites.procurment.good-received-note.index',
'sites.procurment.good-receipt-inspection.index', 'sites.procurment.invoice.index', 'sites.procurment.tax.index',
'sites.procurment.other-cost.index'])
<li class="menu-item {{ request()->routeIs('sites.procurment.purchase-requisition.*') ||
        request()->routeIs('sites.procurment.request-for-proposal.*') ||
        request()->routeIs('sites.procurment.purchase-order.*') ||
        request()->routeIs('sites.procurment.good-received-note.*') ||
        request()->routeIs('sites.procurment.good-receipt-inspection.*') ||
        request()->routeIs('sites.procurment.performance-report.*') ||
        request()->routeIs('sites.procurment.invoice.*') ||
        request()->routeIs('sites.procurment.tax.*') ||
        request()->routeIs('sites.procurment.other-cost.*')
            ? 'active open'
            : null }}">
  <a class="menu-link menu-toggle" href="#">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 15.32" class="menu-icon">
      <defs>
        <style>
          .cls-1 {
            fill: #6d6371;
          }
        </style>
      </defs>
      <g id="Layer_2" data-name="Layer 2">
        <g id="Layer_1-2" data-name="Layer 1">
          <path class="cls-1"
            d="M21,10.2c0-.27,0-.54,0-.81s-.16-.48-.43-.44c-.44.07-.55-.19-.64-.52a2.61,2.61,0,0,0-.24-.54c-.1-.15-.1-.26,0-.37.49-.39.31-.73-.07-1.06a4.51,4.51,0,0,1-.54-.53c-.27-.29-.56-.34-.83,0s-.35.22-.58.07A3.39,3.39,0,0,0,17,5.71c-.11,0-.27,0-.27-.21,0-.6-.37-1.14-.26-1.77a8.05,8.05,0,0,0,0-1.3A2.2,2.2,0,0,0,14.07,0H4.39A2.07,2.07,0,0,0,4,0a.32.32,0,0,0-.3.37A.31.31,0,0,0,4,.71a3.12,3.12,0,0,0,.43,0h9.79a2,2,0,0,1,.65.05c.27.1.35.18.11.42-2,2.05-4,4.11-6,6.15a.84.84,0,0,1-1.36,0c-.35-.36-.69-.73-1-1.1Q4,3.55,1.53.9A.63.63,0,0,1,2,.73c.27,0,.49-.12.45-.4S2.14,0,1.86,0A2.11,2.11,0,0,0,0,2.19V9.93A2.11,2.11,0,0,0,2.29,12.2h9.53c-.55.88-.55.88.19,1.62l.27.27c.26.29.55.35.81,0s.37-.21.61-.07a5,5,0,0,0,.64.26c.16,0,.3.1.27.32-.08.58.26.72.75.69h.81c.39,0,.63-.17.59-.59,0-.26.08-.38.32-.45a4.65,4.65,0,0,0,.7-.28c.14-.07.27-.14.38,0,.44.57.78.29,1.13-.11.17-.18.36-.35.54-.53a.44.44,0,0,0,0-.74.42.42,0,0,1-.09-.64,2.8,2.8,0,0,0,.27-.64c0-.14.07-.25.23-.23C20.94,11.18,21,10.76,21,10.2ZM15.6,1.51a.6.6,0,0,1,.2.52c0,.79,0,1.59,0,2.38,0,.26-.08.35-.34.32-.52-.05-1,0-.87.72,0,.19-.15.21-.28.26a3.3,3.3,0,0,0-.64.26.37.37,0,0,1-.58-.07c-.27-.31-.56-.27-.82,0a5.78,5.78,0,0,1-.5.49c-.42.35-.64.71-.09,1.13.17.13.05.26,0,.38s-.21.07-.31,0l-1.18-.85Zm-14.83,9a2.65,2.65,0,0,1-.06-.69V2.54c0-.13,0-.26,0-.38,0-.27,0-.64.22-.73s.38.26.54.43C3,3.48,4.52,5.12,6.07,6.73c.26.28.22.4-.06.6C4.45,8.46,2.9,9.59,1.37,10.75,1,11.06.85,10.85.77,10.52Zm10.26,1H2.18c-.16,0-.31,0-.56-.08L5.75,8.37,6,8.18a2.44,2.44,0,0,1,.75-.51c.29-.08.42.32.66.46a1.51,1.51,0,0,0,2-.26c.23-.22.37-.26.62,0,.41.33.85.61,1.27.92,0,0,0,.06,0,.09l0,.05c-.26.16-.74-.1-.84.31a4,4,0,0,0,0,1.61c0,.29.35.31.62.3s.33,0,.32.26S11.16,11.51,11,11.51Zm9-1.13c-.44,0-.59.21-.68.6a2.91,2.91,0,0,1-.34.84c-.22.37-.36.68.05,1,.25.23-.1.32-.19.45s-.2.29-.37.07c-.28-.38-.59-.31-.93-.08a2.72,2.72,0,0,1-.74.32c-.42.13-.84.21-.79.81,0,.27-.24.12-.3.15-.34.06-.48,0-.46-.32s-.14-.48-.47-.55a3,3,0,0,1-1.13-.47c-.29-.19-.54-.21-.76.07s-.29.21-.45,0-.43-.28-.1-.54.23-.49.06-.77a3.66,3.66,0,0,1-.38-.83c-.12-.43-.2-.84-.81-.8-.28,0-.14-.27-.16-.42s0-.35.23-.32c.48.06.62-.23.69-.63a2.7,2.7,0,0,1,.4-.94c.2-.28.26-.57,0-.81s-.06-.35.08-.5.27-.29.46,0,.51.24.81.06a3.28,3.28,0,0,1,.83-.38c.43-.1.8-.2.76-.77,0-.28.25-.18.41-.19s.35,0,.33.22c0,.51.29.63.68.73a2.72,2.72,0,0,1,.84.35c.35.22.64.29.94-.07s.31,0,.42.12.37.21.13.41c-.4.33-.27.64,0,1a2.35,2.35,0,0,1,.32.79c.09.42.22.72.72.67.31,0,.21.23.22.39S20.34,10.4,20,10.38Z" />
          <path class="cls-1"
            d="M15.71,7.42a2.49,2.49,0,0,1,2,.91c.16.18.39.4.13.64s-.46,0-.65-.18a1.9,1.9,0,1,0,.34,1.8c0-.15.06-.32.12-.47A.32.32,0,0,1,18,9.91a.3.3,0,0,1,.26.3,1.59,1.59,0,0,1-.13.68,2.59,2.59,0,0,1-3.08,1.63,2.62,2.62,0,0,1-1.95-2.69A2.58,2.58,0,0,1,15.71,7.42Z" />
        </g>
      </g>
    </svg>
    <span class="menu-title text-truncate" data-i18n="sales-cycle">Purchase Cycle</span>

  </a>
  <ul class="menu-sub">

    @can('sites.procurment.purchase-requisition.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.purchase-requisition.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.purchase-requisition.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Purchase Requisition">Purchase Requisition</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.request-for-proposal.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.request-for-proposal.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.request-for-proposal.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Purchase Request">Request for Quotation</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.purchase-order.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.purchase-order.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.purchase-order.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Purchase Request">Purchase Order</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.good-receipt-inspection.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.good-receipt-inspection.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.good-receipt-inspection.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Purchase Request">Goods Receipt Inspection</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.good-received-note.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.good-received-note.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.good-received-note.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Purchase Request">Goods Received Note</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.performance-report.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.performance-report.*') ? 'active ' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.performance-report.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Performance Report">Performance Report</span>
      </a>
    </li>
    @endcan

    @can('sites.procurment.invoice.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.invoice.*') ? 'active ' : null }}">
      <a class="menu-link" href="{{ route('sites.procurment.invoice.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Purchase Request">Invoice</span>
      </a>
    </li>
    @endcan

    {{-- Tax --}}
    {{-- @can('sites.procurment.tax.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.tax.*') ? 'active' : null }}">
      <a class="menu-link" href="{{ route('sites.procurment.tax.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Tax">Tax</span>
      </a>
    </li>
    @endcan --}}

    {{-- other cost --}}
    {{-- @can('sites.procurment.other-cost.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.other-cost.*') ? 'active' : null }}">
      <a class="menu-link"
        href="{{ route('sites.procurment.other-cost.index', ['site_id' => encryptParams($site_id)]) }}">

        <span class="menu-title text-truncate" data-i18n="Tax">Others Cost</span>
      </a>
    </li>
    @endcan --}}
    {{-- @can('sites.procurment.invoice.index')
    <li class="menu-item {{ request()->routeIs('sites.procurment.invoice.*') ? 'active ' : null }}">
      <a class="menu-link" href="{{ route('sites.procurment.invoice.index', ['site_id' => encryptParams($site_id)]) }}">
      </a>
    </li>

  </ul>
</li>
@endcan
@endcanany --}}
