<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sites IP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <br />
    <br />
    <br />
    <h1>Sites IP</h1>
    <p>Upload a csv with the sites list to get their IP Addresses</p>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="custom-file">
                <input type="file" name="the-file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
            <small id="emailHelp" class="form-text text-muted"><a href="https://docs.google.com/spreadsheets/d/1nL8rIC4b44QCaKh1L2QF4x66blC6w4p1wDxyOwqMu1E/edit?usp=sharing" target="_blank">Example File</a></small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>