<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
      </head>
<body>

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">First Panel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Second Panel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Third Panel</a>
        </li>
    </ul><!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <p>First Panel</p>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <p>Second Panel</p>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel">
            <p>Third Panel</p>
        </div>
    </div>
    
</body>
</html>
