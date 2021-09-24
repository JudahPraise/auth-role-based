@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__bounce" role="alert" >
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>List of users</h2>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                               <tr>
                                   <th scope="row">{{ $loop->index+1 }}</th>
                                   <td>{{ $user->name }}</td>
                                   <td>{{ $user->email }}</td>
                                   <td>
                                       <button class="btn btn-sm btn-primary" id="passwordBtn" 
                                       data-toggle="modal" data-target="#exampleModal"
                                       data-email="{{ $user->email }}">
                                           Forgot Password
                                       </button>
                                   </td>
                               </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Forgot Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="row d-flex flex-column align-items-center">
                <p style="font-weight: bold;">You're code is</p>
                <h1 style="font-weight: bold; letter-spacing: 3px;" id="codeContainer"></h1>

                <form action="{{ route('code.add') }}" method="POST" id="codeForm">
                    @csrf
                    <input type="text" name="email" id="emailInput" hidden>
                    <input type="text" name="code" id="codeInput" hidden>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-secondary" onclick="document.getElementById('codeForm').submit()">Add</button>
        </div>
      </div>
    </div>
</div>

<script>
    const passwordBtn = document.getElementById('passwordBtn'); 
    passwordBtn.addEventListener("click", function () {
        const codeContainer = document.getElementById('codeContainer');
        const emailInput = document.getElementById('emailInput');
        const codeInput = document.getElementById('codeInput');
        var code = Math.floor(100000 + Math.random() * 900000);

        codeContainer.innerHTML = code;
        codeInput.value = code;
        emailInput.value = this.dataset.email
    })
</script>
@endsection
