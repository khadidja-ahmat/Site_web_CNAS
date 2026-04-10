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
  <div class="form-container">
     <h4 >Modifier un apropos</h4>


                  <h4 >Modifier une adresse</h4>


                        <form method="POST" action="{{route('admin.adresses.update', $actualite->id)}}" >
                            @csrf
                            @method('put')

                            <div class="mb-3">
                    <label for="titre" class="form-label">Tel</label>
                    <input type="text" name="titre" class="form-control" id="titre"  value="{{$actualite->titre}}" required>
                </div>
                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="text" name="heure" class="form-control" id="heure" value="{{$actualite->image}}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{$actualite->description}}" required>
                </div>
                <div class="mb-3">
                    <label for="site" class="form-label">Site web</label>
                    <input type="text" name="site" class="form-control" id="site" value="{{$actualite->description1}}" required>
                </div>
                 <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" id="adresse" value="{{$actualite->description1}}" required>
                </div>
                 <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" id="lieu" value="{{$actualite->description2}}" required>
                </div>
                <div class="flex-end" >
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Update</button>
                                <a href="{{route('adresses.index')}}" class="btn btn-outline-warning mb-3">Cancel</a>
                            </div>

                        </form>  </div>
</body>
</html>

