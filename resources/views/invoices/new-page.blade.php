<!-- resources/views/new-page.blade.php -->

@extends('layout.app') <!-- Si vous avez déjà un layout, sinon, vous pouvez créer un fichier layout spécifique -->

@section('content')
<!--/div-->
<div class="modal fade" id="counter-info-modal" tabindex="-1" role="dialog" aria-labelledby="counter-info-modal-label"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
  
    <div class="modal-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>Counter Reference:</td>
            <td><span id="modal-counter-reference"></span></td>
          </tr>
          <tr>
            <td>Counter Type:</td>
            <td><span id="modal-counter-type"></span></td>
          </tr>
          <tr>
            <td>Local Label:</td>
            <td><span id="modal-local-label"></span></td>
          </tr>
          <!-- Add more counter information fields here as needed -->
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>



  @endsection
  