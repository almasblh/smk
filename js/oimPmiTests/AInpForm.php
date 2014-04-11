
<form class="form">
    <div class="row">
<?php
    $p_5=16*0.05+4;
    $p_25=16*0.25+4;
    $p_50=16*0.5+4;
    $p_75=16*0.75+4;
    $p_95=16*0.95+4;
?>
        <table>
            <tr>
                <td>
                    <label for="AInp5"><?php echo '5% - '.$p_5.'ма'; ?></label>
                    <input name="AInp5" type="text" style="with:20px" />
                </td>
                <td>
                    <label for="AInp25"><?php echo '25% - '.$p_25.'ма'; ?></label>
                    <input name="AInp25" type="text" style="with:20px" />
                </td>
                <td>
                    <label for="AInp50"><?php echo '50% - '.$p_50.'ма'; ?></label>
                    <input name="AInp50" type="text" style="with:20px" />
                </td>
                <td>
                    <label for="AInp75"><?php echo '75% - '.$p_75.'ма'; ?></label>
                    <input name="AInp75" type="text" style="with:20px" />
                </td>
                <td>
                    <label for="AInp95"><?php echo '95% - '.$p_95.'ма'; ?></label>
                    <input name="AInp95" type="text" style="with:20px" />
                </td>
            </tr>
        </table>
    </div>

    <div class="row buttons">
        <input type="submit" name="yt0" value="Записать данные в базу" />
    </div>
</form>

