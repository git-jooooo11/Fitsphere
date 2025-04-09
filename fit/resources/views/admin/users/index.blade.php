@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users Management') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table id="users-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{ route('admin.users.list') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { 
                    data: 'role',
                    render: function(data, type, row) {
                        return `
                            <select class="form-select user-role" data-id="${row.id}">
                                <option value="user" ${data === 'user' ? 'selected' : ''}>User</option>
                                <option value="admin" ${data === 'admin' ? 'selected' : ''}>Admin</option>
                            </select>
                        `;
                    }
                },
                { 
                    data: 'status',
                    render: function(data, type, row) {
                        return `
                            <div class="form-check form-switch">
                                <input class="form-check-input user-status" type="checkbox" 
                                       id="status-${row.id}" data-id="${row.id}" 
                                       ${data ? 'checked' : ''}>
                                <label class="form-check-label" for="status-${row.id}">
                                    ${data ? 'Active' : 'Inactive'}
                                </label>
                            </div>
                        `;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <a href="/profile/${row.id}" class="btn btn-sm btn-info">View</a>
                        `;
                    }
                }
            ]
        });

        // Handle user status change
        $(document).on('change', '.user-status', function() {
            const userId = $(this).data('id');
            const isChecked = $(this).prop('checked');
            
            $.ajax({
                url: `/admin/users/${userId}/status`,
                type: 'PUT',
                data: {
                    status: isChecked ? 1 : 0,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    const label = $(`label[for="status-${userId}"]`);
                    label.text(isChecked ? 'Active' : 'Inactive');
                    
                    // Show success message
                    alert('User status updated successfully');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error updating user status');
                    // Revert the toggle
                    $(this).prop('checked', !isChecked);
                }
            });
        });

        // Handle user role change
        $(document).on('change', '.user-role', function() {
            const userId = $(this).data('id');
            const role = $(this).val();
            
            $.ajax({
                url: `/admin/users/${userId}/role`,
                type: 'PUT',
                data: {
                    role: role,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Show success message
                    alert('User role updated successfully');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error updating user role');
                    // Reload the table to reset the selection
                    $('#users-table').DataTable().ajax.reload();
                }
            });
        });
    });
</script>
@endpush