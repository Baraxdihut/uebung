<div class="form-group visible" id="rahmentyp-group">
            <label for="rahmentyp">Bitte wählen Sie einen Rahmentypen:</label>
            <select class="form-control" id="rahmentyp" name="rahmentyp" onchange="updateSelection('rahmentyp', 'farbe-group')">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDRahmentyp, Bezeichnung FROM tbl_rahmentypen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDRahmentyp'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Rahmentypen gefunden</option>";
                }
                ?>
            </select>
        </div>