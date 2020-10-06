
<div class="col-md-12">
        <div class="card">
            <div class="card-header">AUDIT TRAILS</div>

            <div class="card-body">

                <div class="col-md-12">

                    <form class="offset-1">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">End Date</label>
                                <input type="datetime-local" class="form-control" id="end_date">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Name</label>
                               <select class="form-control" id="name">
                                   <option></option>
                                   <option value="Codelikeice">Codelikeice</option>
                                   <option value="GreenZone">GreenZone</option>
                                   <option value="Shoe">Shoe</option>
                                   <option value="Fish">Fish</option>
                                   <option value="Meat">Meat</option>
                               </select>
                            </div>
                        </div>
                        <div class="offset-3">
                            <button type="button" class="btn btn-primary" id="generate">Generate</button>
                            <button type="button" class="btn btn-danger" id="reset">Reset</button>
                        </div>
                    </form>
                </div>
                <br>

                {!! $dataTable->table() !!}

            </div>
        </div>
    </div>













