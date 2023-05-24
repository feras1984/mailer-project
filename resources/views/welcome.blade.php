<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">


    <title>Mailer Class</title>
</head>
<body>
<div class="container">
    <div class="p-4">
        <div class="card">
            <div class="card-title">
                <div class="px-3 py-2">
                    <h3 class="m-0">New Message</h3>
                </div>
            </div>
            <div class="card-content px-2 py-3">
                <div class="input-group has-validation mb-3">
                    <span class="input-group-text" id="basic-addon3">To</span>
                    <input type="text" class="form-control" id="recipient" aria-describedby="basic-addon3">
                    <div class="invalid-feedback invalid-recipient"></div>
                </div>

                <div class="input-group has-validation mb-3">
                    <span class="input-group-text" id="basic-addon3">CC</span>
                    <input type="text" class="form-control" id="cc" aria-describedby="basic-addon3">
                    <div class="invalid-feedback invalid-cc"></div>
                </div>

                <div class="input-group has-validation mb-3">
                    <span class="input-group-text" id="basic-addon3">BCC</span>
                    <input type="text" class="form-control" id="bcc" aria-describedby="basic-addon3">
                    <div class="invalid-feedback invalid-bcc"></div>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Subject</span>
                    <input type="text" class="form-control" id="subject" aria-describedby="basic-addon3">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message Content</label>
                    <textarea class="form-control" id="content" rows="3"></textarea>
                </div>
                <div class="px-4 py-3">
                    <div class="d-flex flex-column align-items-start display-files"></div>
                    <button type="button" class="btn btn-primary rounded-circle button-circle" id="add-file" title="add attachment">
                        <i class="bi bi-plus"></i>
                    </button>
                    <input type="file" class="d-none" id="file-upload">
                </div>
                <div class="px-4 py-3">
                    <button type="button" class="btn btn-secondary" id="submit">Send</button>
                </div>
                <div class="px-4 py-3" id="infoMessage">

                </div>

                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>

