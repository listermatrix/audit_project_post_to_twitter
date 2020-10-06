
<div class="card">
<div class="card-header">Dashboard</div>
<div class="card-body">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <td>id</td>
                <td>Output</td>

            </tr>
            </thead>


            <tbody>

                <tr>
                    <td>1</td>
                    <td>{{$log_output}}</td>

                </tr>
            </tbody>


        </table>
</div>
</div>

