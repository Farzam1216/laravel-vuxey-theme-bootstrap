@if ($type == 'user_profile')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($leave_policies) && count($leave_policies) > 0)
                @foreach ($leave_policies as $policy)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $policy->name ?? '-' }}</td>
                        <td>{{ $policy->leavePolicyType->name ?? '-' }}</td>
                        <td>{{ $policy->quantity ?? '-' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endif
