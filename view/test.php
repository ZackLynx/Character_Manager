<?php
/*
-----------------------------------------------------------------------------------------------
Name:		test.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-04-19
Language:	PHP
Purpose:	This is for testing new additions to the character sheet.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-04-19		Original Version, testing the implementation of feats.
CBAC        2025-04-24      Now testing the addition of the Inventory system.
CBAC        2025-04-25      Beginning migration to npc_sheet.
CBAC        2025-04-26      Added button for refactoring skills.
-----------------------------------------------------------------------------------------------
*/
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Character Manager</title>
        <!-- Use an absolute path From the server root, so nested pages can use the CSS -->
        <link rel="stylesheet" href="/Character_Manager/css/main.css">
        <!-- <link rel="stylesheet" href="/000_CPT-250-F41/Connor/Character_Manager/css/main.css"> -->
    </head>

    <body>


        <form action="." method="post" hidden>
            <p>
                Skill Refactor
            </p>
            <input type="hidden" name="action" value="migrate-skills">
            <input type="submit" value="BEGIN SKILL REFACTOR">
        </form>
        <form action="." method="post">

            <div id="keystroke-test" hidden>
                <p id="echo">

                </p>
                <input type="number" name="wurds" id="wurds">
            </div>
            <div id="feats-block" hidden>
                <p>
                    Feats
                </p>
                <div id="feat-list">
                    <?php $featNum = 0;
                    if (isset($character_feats)) {
                        foreach ($character_feats as $feat): ?>
                            <div id="feat_<?php echo $featNum; ?>" class="feat-box">
                                <input hidden="hidden" name="feat_<?php echo $featNum; ?>_ID" id="feat_<?php echo $featNum; ?>_ID" value="<?php echo $feat['Feat_ID'] ?? 0; ?>">
                                <label for="feat_<?php echo $featNum; ?>_name" class="feat-label">Feat Name: </label>
                                <input type="text" name="feat_<?php echo $featNum; ?>_name" id="feat_<?php echo $featNum; ?>_name" class="feat-field" value="<?php echo $feat['Feat_Name']; ?>" required>
                                <button type="button" class="feat-delete-button" value="<?php echo $feat['Feat_ID'] ?? 0; ?>">Delete Feat</button>
                                <br>
                                <label for="feat_<?php echo $featNum; ?>_desc" class="feat-label">Description:</label>
                                <br>
                                <textarea name="feat_<?php echo $featNum; ?>_desc" id="feat_<?php echo $featNum; ?>_desc" class="feat-field feat_desc"><?php echo $feat['Feat_Desc']; ?></textarea>
                            </div>
                            <?php $featNum++;
                        endforeach;
                    } ?>
                </div>
                <div class="center-button">
                    <button type="button" id="add-feat-button">Add A Feat</button>
                </div>
                <input type="text" name="num-of-feats" id="num-of-feats" value="<?php echo $featNum; ?>" hidden>
                <input type="text" name="feats-to-delete" id="feats-to-delete" hidden>
            </div>
            <div id="inventory" hidden>
                <p>
                    Inventory
                </p>
                <div id="inventory-list">
                    <?php $ItemNum = 0;
                    if (isset($inventory)) {
                        foreach ($inventory as $item): ?>
                            <div id="item_<?php echo $ItemNum; ?>" class="item-box">
                                <input hidden="hidden" name="item_<?php echo $ItemNum; ?>_ID" id="item_<?php echo $ItemNum; ?>_ID" value="<?php echo $item['Inventory_ID'] ?? 0; ?>">
                                <label for="item_<?php echo $ItemNum; ?>_name" class="item-label">Item Name: </label>
                                <input type="text" name="item_<?php echo $ItemNum; ?>_name" id="item_<?php echo $ItemNum; ?>_name" class="item-field" value="<?php echo $item['Item_Name']; ?>" required>
                                <button type="button" class="item-delete-button" value="<?php echo $item['Inventory_ID'] ?? 0; ?>">Delete item</button>
                                <br>
                                <label for="item_<?php echo $ItemNum; ?>_desc" class="item-label">Description:</label>
                                <br>
                                <textarea name="item_<?php echo $ItemNum; ?>_desc" id="item_<?php echo $ItemNum; ?>_desc" class="item-field item_desc"><?php echo $item['Item_Desc']; ?></textarea>
                            </div>
                            <?php $ItemNum++;
                        endforeach;
                    } ?>
                </div>
                <div class="center-button">
                    <button type="button" id="add-item-button">Add An Item</button>
                </div>
                <input type="text" name="num-of-items" id="num-of-items" value="<?php echo $ItemNum; ?>" hidden>
                <input type="text" name="items-to-delete" id="items-to-delete" hidden>
            </div>

            <div id="tabs">
                <button type="button" id="button-tab-1">Tab 1</button>
                <button type="button" id="button-tab-2">Tab 2</button>
                <button type="button" id="button-tab-3">Tab 3</button>
            </div>

            <div>
                <div id="tab1">
                    <p>This is Tab 1</p>
                </div>
                <div id="tab2" hidden>
                    <p>This is Tab 2</p>
                </div>
                <div id="tab3" hidden>
                    <p>This is Tab 3</p>
                </div>
            </div>
            <input type="hidden" name="action" value="test-input">
            <input type="submit" value="Submit for testing">
        </form>

    </body>

    <script src="./js/test.js"></script>
</html>
