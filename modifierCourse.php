<div class="update">
    <div class="modal">
        <div class="overflow"></div>
        <div class="addCourse modalContent">

            <form action="controllers/updatecourse.php" method="POST">

                <div class="flex">
                    <h2>Modifier une course</h2>
                    <div class="undisplayModal">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>

                <div class="flex inputFlex">
                    <div class="input">
                        <input type="hidden" name="course_id" value="<?php echo $courseDetails['course_id']; ?>">
                        <label for="point_depart">Point de départ :</label>
                        <input type="text" id="point_depart" name="point_depart" value="<?php echo $courseDetails['point_depart']; ?>" required><br><br>
                    </div>

                    <div class="input">
                        <label for="point_arrivee">Point d'arrivée :</label>
                        <input type="text" id="point_arrivee" name="point_arrivee" value="<?php echo $courseDetails['point_arrivee']; ?>" required><br><br>
                    </div>
                </div>

                <div class="flex inputFlex">
                    <div class="input">
                        <label for="date_heure">Date et heure :</label>
                        <input type="datetime-local" id="date_heure" name="date_heure" value="<?php echo date('Y-m-d\TH:i', strtotime($courseDetails['date_heure'])); ?>" required><br><br>

                    </div>

                    <div class="input">
                        <label for="statut">Statut :</label>

                        <select id="chauffeur_id" name="statut" required>
                            <option value="0" <?php if ($courseDetails['statut'] == 0) echo 'selected'; ?>>En attente</option>

                            <option value="1" <?php if ($courseDetails['statut'] == 1) echo 'selected'; ?>>En cours</option>

                            <option value="2" <?php if ($courseDetails['statut'] == 1) echo 'selected'; ?>>Terminée</option>
                        </select>
                    </div>
                </div>

                <div class="input chauffeur">
                    <label for="chauffeur_id">Chauffeur :</label>
                    <select id="chauffeur_id" name="chauffeur_id" required>
                        <?php foreach ($chauffeurs as $chauffeur) : ?>
                            <option value="<?php echo $chauffeur['chauffeur_id']; ?>" <?php if ($chauffeur['chauffeur_id'] == $courseDetails['chauffeur_id']) echo 'selected'; ?>><?php echo $chauffeur['nom'] . ' ' . $chauffeur['prenoms']; ?></option>
                        <?php endforeach; ?>
                    </select><br><br>
                </div>

                <input class="submitButton button" type="submit"  type="submit" value="Modifier">
            </form>
        </div>
    </div>
</div>