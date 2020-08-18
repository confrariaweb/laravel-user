<table class="table table-striped table-hover table-sm" id="users-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Perfis</th>
            <th>Criado</th>
            <th>UAtualizado</th>
            <th>#</th>
        </tr>
    </thead>
</table>

@push('scripts')
    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.users.datatables") }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

    </script>
@endpush
