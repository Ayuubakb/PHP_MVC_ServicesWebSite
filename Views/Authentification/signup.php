<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="http://localhost/Bricolini/Views/public/style/Style.css">
</head>
<body >
<?php  require('Views/Components/Nav.php'); ?>
    <section class="signup">
        <div class="holder">
            <h1>Inscrivez Vous a Bricoliini !</h1>
            <form action="http://localhost/Bricolini/Authentification/signup" method="post" enctype="multipart/form-data">
                <div class="general">
                    <div class="ins">
                        <input type="text" name="LastName" placeholder="Nom" required>
                        <input type="text" name="FirstName" placeholder="Prénom" required>
                    </div>
                    <div class="ins">
                        <input type="text" name="Email" placeholder="Email" required>
                        <input type="text" name="Telephone" placeholder="Téléphone" required>
                    </div>
                    <div class="ins">
                        <input type="password" name="password" placeholder="Mot De Passe" required>
                    </div>
                    <div class="clientType">
                        <label>
                            <input type="radio" value="partenaire" name="checkClient" id="isPartenaireCheck"> Je suis un partenaire
                        </label>
                        <label>
                            <input type="radio" value="client" name="checkClient" id="isClientCheck"> Je suis un client
                        </label>
                    </div>
                </div>
                <div id="champClient" class="champClient" style="display: none;">
                    <div>
                        <input type="text" name="Address" placeholder="Adresse">
                    </div>
                    <input type="submit" value="S'inscrire" class="btnSubmit">
                </div>
                <div id="champsPartenaire" class="champsPartenaire" style="display: none;">
                    <div class="partenaireInfos">
                        <select name="Metier">
                            <option value="Jardinage" selected>Jardinage</option>
                            <option value="Menage">Menage</option>
                        </select>
                        <input type="text" name="Ville" placeholder="Ville">
                        <input type="number" name="YearExperience" placeholder="Années d'expérience" min=0>
                    </div>
                    <div class="creneaux">
                        <h1 style="width:20%;margin-left:0;font-size:18px;display:flex;align-items:center;justify-content:space-around;">
                            Regler<br></br> votre<br></br> Creneaux
                        </h1>
                        <div>
                            <div>
                                <div class="jour">
                                    <label>Lundi </label>
                                    <input id="jourLundi" type="checkbox" name="days[]" value="Monday"/>
                                </div>
                                <div  style="display: none;" class="horaire" id="lundiHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="lundifrom" id="horaireFromlundi"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="lundito" id="horaireTolundi"/>
                                </div>
                            </div>
                            <div>
                                <div class="jour">
                                    <label>Mardi </label>
                                    <input id="jourMardi" type="checkbox" name="days[]" value="Tuesday"/>
                                </div>
                                <div  style="display: none;" class="horaire" id="mardiHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="mardifrom" id="horaireFrommardi"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="mardito" id="horaireTomardi"/>
                                </div>
                            </div>
                            <div>
                                <div class="jour">
                                    <label>Mercredi </label>
                                    <input id="jourMercredi" type="checkbox" name="days[]" value="Wednesday"/>
                                </div>
                                <div  style="display: none;" class="horaire" id="mercrediHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="mercredifrom" id="horaireFrommercredi"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="mercredito" id="horaireTomercredi"/>
                                </div>
                            </div>
                            <div>
                                <div class="jour">
                                    <label>Jeudi </label>
                                    <input id="jourJeudi" type="checkbox" name="days[]" value="Thursday"/>
                                </div>
                                <div  style="display: none;" class="horaire" id="jeudiHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="jeudifrom" id="horaireFromjeudi"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="jeudito" id="horaireTojeudi"/>
                                </div>
                            </div>
                        </div> 
                        <div>
                            <div>
                                <div class="jour">
                                    <label>Vendredi </label>
                                    <input id="jourVendredi" type="checkbox" name="days[]" value="Friday"/>
                                </div>
                                <div  style="display: none;" class="horaire" id="vendrediHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="vendredifrom" id="horaireFromvendredi"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="vendredito" id="horaireTovendredi"/>
                                </div>
                            </div>
                            <div>
                                <div class="jour">
                                    <label>Samedi </label>
                                    <input id="jourSamedi" type="checkbox" name="days[]" value="Saturday"/>
                                </div> 
                                <div  style="display: none;" class="horaire" id="samediHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="samedifrom" id="horaireFromsamedi"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="samedito" id="horaireTosamedi"/>
                                </div>
                            </div>
                            <div>
                                <div class="jour">
                                    <label>Dimanche </label>
                                    <input id="jourDimanche" type="checkbox" name="days[]" value="Sunday"/>
                                </div>
                                <div  style="display: none;" class="horaire" id="dimancheHoraire">
                                    <input max=23 min=0 placeholder="De" type="number" name="dimanchefrom" id="horaireFromdimanche"/>
                                    <input max=23 min=0 placeholder="à" type="number" name="dimancheto" id="horaireTodimanche"/>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <input type="submit" value="S'inscrire" class="btnSubmit"/>
                </div>
            </form>    
        </div>
    </section>
    <script>
        document.getElementById('isPartenaireCheck').addEventListener('change', function() {
            if(this.checked){
                document.getElementById('champsPartenaire').style.display = "block";
                document.getElementById('champClient').style.display = "none";
            }else{
                document.getElementById('champsPartenaire').style.display = "none";
                document.getElementById('champClient').style.display = "block";
            }
        });
        document.getElementById('isClientCheck').addEventListener('change', function() {
            if(this.checked){
                document.getElementById('champsPartenaire').style.display = "none";
                document.getElementById('champClient').style.display = "block";
            }else{
                document.getElementById('champsPartenaire').style.display = "block";
                document.getElementById('champClient').style.display = "none";
            }
        });
        document.getElementById("jourLundi").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('lundiHoraire').style.display = display;
        })
        document.getElementById("jourMardi").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('mardiHoraire').style.display = display;
        })
        document.getElementById("jourMercredi").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('mercrediHoraire').style.display = display;
        })
        document.getElementById("jourJeudi").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('jeudiHoraire').style.display = display;
        })
        document.getElementById("jourVendredi").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('vendrediHoraire').style.display = display;
        })
        document.getElementById("jourSamedi").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('samediHoraire').style.display = display;
        })
        document.getElementById("jourDimanche").addEventListener("change",function(){
            var display = this.checked ? 'block' : 'none';
            document.getElementById('dimancheHoraire').style.display = display;
        })
    </script>
</body>
</html>