 foreach ($_SESSION['grille'] as $value) {

                if ($value->etat_carte === 1) { ?>
                    <div>
                        <form method='POST' action=''>
                            <input type="hidden" name="id_carte" value="<?= $value->id_carte ?>" />
                            <input type="hidden" name="etat_carte" value="<?= $value->etat_carte ?>" />
                            <input type="hidden" name="face_carte" value="<?= $value->face_carte ?>" />
                            <button type='submit' name="submit">
                                <img src="<?= $value->dos_carte ?>" alt="carte de dos" width='60vw' height='60vh'>
                            </button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div>
                        <img src="<?= $value->face_carte ?>" alt="carte de dos" width='60vw' height='60vh'>
                    </div>

            <?php
                }
            };  
