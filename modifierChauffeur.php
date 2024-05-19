<div class="update">
    <div class="modal">
        <div class="overflow"></div>
        <div class="addCourse modalContent">

            <form action="controllers/updatechauffeur.php" method="POST">

                <div class="flex">
                    <h2>Modifier un chauffeur</h2>
                    <div class="undisplayModal">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>

                <div class="flex inputFlex">
                    <div class="input">
                        <input type="hidden" name="chauffeur_id" value="<?php echo $chauffeurDetails['chauffeur_id']; ?>">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?php echo $chauffeurDetails['nom']; ?>" required><br><br>
                    </div>

                    <div class="input">
                        <label for="prenoms">Prénoms :</label>
                        <input type="text" id="prenoms" name="prenoms" value="<?php echo $chauffeurDetails['prenoms']; ?>" required><br><br>
                    </div>
                </div>

                <div class="flex inputFlex">
                    <div class="input">
                        <label for="telephone">Téléphone :</label>
                        <input type="text" id="telephone" name="telephone" value="<?php echo $chauffeurDetails['telephone']; ?>" required><br><br>

                    </div>

                    <div class="input">
                        <label for="sexe">Sexe :</label> <br>

                        <select id="sexe" name="sexe" required>
                            <option value="M" <?php if ($chauffeurDetails['sexe'] == 'M') echo 'selected'; ?>>Masculin</option>
                            <option value="F" <?php if ($chauffeurDetails['sexe'] == 'F') echo 'selected'; ?>>Féminin</option>
                        </select>
                    </div>
                </div>

                <div class="flex inputFlex">
                    <div class="input">
                        <label for="disponible">Disponible :</label>
                        <select id="disponible" name="disponible" required>
                            <option value="1" <?php if ($chauffeurDetails['disponible'] == 1) echo 'selected'; ?>>Oui</option>
                            <option value="0" <?php if ($chauffeurDetails['disponible'] == 0) echo 'selected'; ?>>Non</option>
                        </select><br><br>
                    </div>
                </div>

                <input class="submitButton button" type="submit" value="Modifier">
            </form>
        </div>
    </div>
</div>