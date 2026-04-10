<!DOCTYPE html>
<html>
<head>

  <title>create</title>
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
        <div class="container">

            <div class="container my-5">
                <div class="container my-5 row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6 card">
                        <h4 >Modifier une activité</h4>


                        <form method="POST" action="{{route('activites.update', $activite->id)}}" >
                            @csrf
                            @method('put')

                            <div class="mb-3">
                    <label for="titre" class="form-label">titre</label>
                    <input type="text" name="titre" class="form-control" id="titre"  value="{{$activite->titre}}" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{$activite->image}}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" name="description" class="form-control" id="description" value="{{$activite->description}}" required>
                </div>
                <div class="flex-end" >
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Update</button>
                                <a href="{{route('activites.index')}}" class="btn btn-outline-warning mb-3">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>
