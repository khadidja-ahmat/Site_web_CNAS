<section id="about">
        <div class="container">

        <div class="container my-5">
            <h4>Nouvea adresse</h4>


            <form method="POST" action="{{route('admin.adresses.store')}}" enctype="multipart/form-data">

                @csrf
                <div class="mb-3">
                    <label for="tel" class="form-label">Tel</label>
                    <input type="text" name="tel" class="form-control" id="tel" placeholder="entrer la telephone" required>
                </div> 
                  <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="text" name="heure" class="form-control" id="heure" placeholder="entrer la telephone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="entrer l'email" required>
                </div>
                <div class="mb-3">
                    <label for="site" class="form-label">Site-Web</label>
                    <input type="text" name="site" class="form-control" id="site" placeholder="entrer l'email" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" id="adresse" placeholder="entrer l'adresse " required>
                </div>
                  <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" id="lieu" placeholder="entrer l'adresse " required>
                </div>

                               <div class="flex-end" >
                    <button type="submit" class="btn btn-primary mb-3 mx-3">Soumettre</button>
                    <a href="index.php" class="btn btn-outline-warning mb-3">Annuler</a>
                </div>

            </form>
        </div>
    </div>

 </section>