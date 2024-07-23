<!DOCTYPE html>
<html>
<head>
    <title>My Web Page</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            display: flex;
            min-width: 100vw;
            min-height: 100vh;
            background-color: rgb(37, 37, 37);
            margin-top: 50px;
            justify-content: center;
            align-items: center;
        }
        .table {
            display: flex;
            flex-direction: column;
            width: fit-content;
            align-items: center;
            h2 {
                margin-right: 80px;
            }
        }
        .card {
            display: flex;
            flex-direction: row !important;
            padding: 5px 10px;
            margin: 3px 10px;
            background-color: rgb(255, 255, 255);
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            div {
                width: 150px;
            }
        }
        .form-group label {
            margin: 10px;
            width: 100px;
        }
        .modal-header {
            justify-content: space-between;
        }
    </style>
    <script type="text/javascript">
        function add_submit() {
            document.getElementById("add_form").submit();
        }    
        function edit_submit() {
            document.getElementById("delete_form").action = "edit_contact/" + id;
            document.getElementById("edit_form").submit();
        }
        function delete_submit(id) {
            document.getElementById("delete_form").action = "delete_contact/" + id;
            document.getElementById("delete_form").submit();
        }
        function setContactValues(name, company, phone, email) {
            document.getElementById("edit_name").value = name;
            document.getElementById("edit_company").value = company;
            document.getElementById("edit_phone").value = phone;
            document.getElementById("edit_email").value = email;
        }
    </script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @if ($contacts->isEmpty())
        <div class="table">
            <div class="card">
                <h2>Contacts</h2>
                <p>No contacts found.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_contacts" >
                    Add Contacts
                </button>
            </div>
        </div>
    @else
        <div class="table">
            <div class="card">
                <h2>Contacts</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_contacts">
                    Add Contacts
                </button>
            </div>
            <div class="card">
                <div>Name</div>
                <div>Company</div>
                <div>Phone</div>
                <div>Email</div>
                <div></div>
            </div>
            @foreach ($contacts as $item)
                <div class="card">
                    <div>{{ $item->name }}</div>
                    <div>{{ $item->company }}</div>
                    <div>{{ $item->phone }}</div>
                    <div>{{ $item->email }}</div>
                    <div>
                        <div style="display: flex; flex-direction: row;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_contact" onclick="setContactValues('{{ $item->name }}', '{{ $item->company }}', '{{ $item->phone }}', '{{ $item->email }}')">
                                Edit
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmation_delete" onclick="delete_submit({{$item->id}})">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    @include('components.header')
    @include('components.footer')
    
    <!-- Modals -->
    <div class="modal fade" id="add_contacts" tabindex="-1" aria-labelledby="AddContacts" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddContacts">Add a contact</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form  id="add_form" method="POST" action="add_contact">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name">                 
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="add_submit()" class="btn btn-primary" form="modal-details">Save Contact</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    
    <div class="modal fade" id="edit_contact" tabindex="-1" aria-labelledby="EditContact" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditContact">Edit Contact</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form  id="edit_form" method="POST" action="edit_contact">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="edit_name" >
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="edit_company" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="edit_phone" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="edit_email" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="edit_submit()" class="btn btn-primary" form="modal-details">Save Contact</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <div class="modal fade" id="confirmation_delete" tabindex="-1" aria-labelledby="ConfirmDelete" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ConfirmDelete">Confirm Delete Contact</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form  id="delete_form" method="POST" action="delete_contact">
                @csrf
                <div class="modal-body">
                    Are you sure you want to delete this contact?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" onclick="delete_submit()" class="btn btn-primary" form="modal-details">Delete</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>
</html>