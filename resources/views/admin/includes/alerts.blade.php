            <!-- exibição de erro, caso tenha -->
            @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @if(session('message'))
            <div class="alert alert-info">
                {{session('message')}}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-warning">
                {{session('error')}}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-info">
                {{session('success')}}
            </div>
            @endif

            @if(session('update'))
            <div class="alert alert-info">
                {{session('update')}}
            </div>
            @endif

            @if(session('delete'))
            <div class="alert alert-danger">
                {{session('delete')}}
            </div>
            @endif

            