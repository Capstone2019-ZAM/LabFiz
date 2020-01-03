@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!  {{ auth()->user()->name }}
                    {{-- PUT YOUR ROLE BASE DISPLAY  --}}
                    
                    @can('isAdmin')                        
                     <label > as an admin </label>                        
                    @endcan

                    @can('isUser')                        
                   
                   
                        <div id="app">
                          <v-app>
                            <v-content>
                              <v-container>Hello world</v-container>
                            </v-content>
                          </v-app>
                        </div>
                      
                        
                        <script>
                          new Vue({
                            el: '#app',
                            vuetify: new Vuetify(),
                          })
                        </script>
                    
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
