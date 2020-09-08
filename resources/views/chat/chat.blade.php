@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'Panel administrativo'])

@section('content')

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Chat</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Chat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
              <h3 class="card-title">Chat Directo</h3>
            </div>
            <div class="card-body">
              <div class="direct-chat-messages">
                <message :messages="messages"></message>
              </div>
            </div>
            <div class="card-footer">
              <sent-message v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></sent-message>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  
@endsection