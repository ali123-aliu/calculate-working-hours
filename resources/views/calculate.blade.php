<!DOCTYPE html>
<html>
<head>
    <title>Working Hours Calculations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form method="post" action="{{ route('calculate') }}">
        @csrf
        <div class="row mt-5 my-3">
            <div class="col">
                <label>Start Date/Time</label>
                <input type="datetime-local" class="form-control" name="start_date">
            </div>
            <div class="col">
                <label>End Date/Time</label>
                <input type="datetime-local" class="form-control" name="end_date">
            </div>
        </div>
        <button type="submit" class="btn btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
