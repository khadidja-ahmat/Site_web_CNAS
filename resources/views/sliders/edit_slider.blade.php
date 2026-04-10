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
         <h4 >Modifier un slider</h4>


                        <form method="POST" action="{{route('admin.sliders.update', $slider->id)}}" >
                            @csrf
                            @method('put')

                            <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" name="titre" class="form-control" id="titre"  value="{{$slider->titre}}" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image" value="{{$slider->image}}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="description" value="{{$slider->description}}" required>
                </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image" value="{{$slider->image}}" required>
                </div>
                <div class="flex-end" >
                                <button type="submit" class="btn btn-primary mb-3 mx-3">Update</button>
                                <a href="{{route('sliders.index')}}" class="btn btn-outline-warning mb-3">Cancel</a>
                </div>

                        </form>
  </div>
</body>
</html>