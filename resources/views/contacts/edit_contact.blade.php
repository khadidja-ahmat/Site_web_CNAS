<!DOCTYPE html>
<html>
<head>
  <title>edit</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    .form-container {
      width: 400px;
      padding: 20px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container label {
      display: block;
      margin-bottom: 10px;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    .form-container textarea {
      height: 100px;
    }

    .form-container button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    .form-container button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<section id="contact" class="contact">

<div class="col-lg-8">
  <div class="php-email-form">
    <h2>modifier contact</h2>
    <form action="{{ route('admin.contacts.update', $contact->id) }}" method="post" role="form" enctype="multipart/form-data" enctype="multipart/form-data">
      @csrf  
      @method('put')
      <div class="row">
        <div class="col-md-6 form-group">
          <input type="text" name="localisation" class="form-control" id="localisation" value="{{$contact->localisation}}" required>
        </div>
        <div class="col-md-6 form-group">
          <input type="text" name="telephone" class="form-control" id="telephone" value="{{$contact->telephone}}" required>
        </div>
        <div class="col-md-6 form-group">
          <input type="text" name="email" class="form-control" id="email" value="{{$contact->email}}" required>
        </div>
        <div class="col-md-6 form-group">
          <input type="text" name="ouverture" class="form-control" id="ouverture" value="{{$contact->ouverture}}" required>
        </div>
        
      <div class="text-center">
        <button type="submit">Soumettre</button>
      </div>
    </form>
  </div>
</div>

    </section>                       
</body>
</html>