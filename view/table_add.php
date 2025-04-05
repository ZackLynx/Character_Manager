<?php
/*
-----------------------------------------------------------------------------------------------
Name:		table_add.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	this is a form for adding a new character to the database.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version.
CBAC        2025-03-13      Corrected improper use of <label> elements.
CBAC        2025-03-26      Added cancel button.
CBAC        2025-03-27      Amended Character Name field to retain its previously entered value.
CBAC        2025-03-31      Added HTML min and max values to ability score input fields.
CBAC        2025-04-04      Legacy code removed, see `table_add_old.php`
-----------------------------------------------------------------------------------------------
*/


// in the event that a value is bad and cannot be used by SQL, we need to hold onto already
// entered data.
$valMemory = [
    'Character_Name' => get_val_from_postget('character-name', ''),
    'Class_ID' => get_val_from_postget('character-class', 0),
    'Race_ID' => get_val_from_postget('character-race', 0),
    'Str_Base' => get_val_from_postget('str-stat', 10),
    'Dex_Base' => get_val_from_postget('dex-stat', 10),
    'Con_Base' => get_val_from_postget('con-stat', 10),
    'Int_Base' => get_val_from_postget('int-stat', 10),
    'Wis_Base' => get_val_from_postget('wis-stat', 10),
    'Cha_Base' => get_val_from_postget('cha-stat', 10),
    'Acrob_Ranks' => get_val_from_postget('Acrob_Ranks', 0),
    'Acrob_Racial' => get_val_from_postget('Acrob_Racial', 0),
    'Acrob_Feats' => get_val_from_postget('Acrob_Feats', 0),
    'Acrob_Misc' => get_val_from_postget('Acrob_Misc', 0),
    'Appra_Ranks' => get_val_from_postget('Appra_Ranks', 0),
    'Appra_Racial' => get_val_from_postget('Appra_Racial', 0),
    'Appra_Feats' => get_val_from_postget('Appra_Feats', 0),
    'Appra_Misc' => get_val_from_postget('Appra_Misc', 0),
    'Bluff_Ranks' => get_val_from_postget('Bluff_Ranks', 0),
    'Bluff_Racial' => get_val_from_postget('Bluff_Racial', 0),
    'Bluff_Feats' => get_val_from_postget('Bluff_Feats', 0),
    'Bluff_Misc' => get_val_from_postget('Bluff_Misc', 0),
    'Climb_Ranks' => get_val_from_postget('Climb_Ranks', 0),
    'Climb_Racial' => get_val_from_postget('Climb_Racial', 0),
    'Climb_Feats' => get_val_from_postget('Climb_Feats', 0),
    'Climb_Misc' => get_val_from_postget('Climb_Misc', 0),
    'Craft_Ranks' => get_val_from_postget('Craft_Ranks', 0),
    'Craft_Racial' => get_val_from_postget('Craft_Racial', 0),
    'Craft_Feats' => get_val_from_postget('Craft_Feats', 0),
    'Craft_Misc' => get_val_from_postget('Craft_Misc', 0),
    'Diplo_Ranks' => get_val_from_postget('Diplo_Ranks', 0),
    'Diplo_Racial' => get_val_from_postget('Diplo_Racial', 0),
    'Diplo_Feats' => get_val_from_postget('Diplo_Feats', 0),
    'Diplo_Misc' => get_val_from_postget('Diplo_Misc', 0),
    'DsDev_Ranks' => get_val_from_postget('DsDev_Ranks', 0),
    'DsDev_Racial' => get_val_from_postget('DsDev_Racial', 0),
    'DsDev_Feats' => get_val_from_postget('DsDev_Feats', 0),
    'DsDev_Misc' => get_val_from_postget('DsDev_Misc', 0),
    'Disgu_Ranks' => get_val_from_postget('Disgu_Ranks', 0),
    'Disgu_Racial' => get_val_from_postget('Disgu_Racial', 0),
    'Disgu_Feats' => get_val_from_postget('Disgu_Feats', 0),
    'Disgu_Misc' => get_val_from_postget('Disgu_Misc', 0),
    'Escar_Ranks' => get_val_from_postget('Escar_Ranks', 0),
    'Escar_Racial' => get_val_from_postget('Escar_Racial', 0),
    'Escar_Feats' => get_val_from_postget('Escar_Feats', 0),
    'Escar_Misc' => get_val_from_postget('Escar_Misc', 0),
    'Fly_Ranks' => get_val_from_postget('Fly_Ranks', 0),
    'Fly_Racial' => get_val_from_postget('Fly_Racial', 0),
    'Fly_Feats' => get_val_from_postget('Fly_Feats', 0),
    'Fly_Misc' => get_val_from_postget('Fly_Misc', 0),
    'Hanim_Ranks' => get_val_from_postget('Hanim_Ranks', 0),
    'Hanim_Racial' => get_val_from_postget('Hanim_Racial', 0),
    'Hanim_Feats' => get_val_from_postget('Hanim_Feats', 0),
    'Hanim_Misc' => get_val_from_postget('Hanim_Misc', 0),
    'Heal_Ranks' => get_val_from_postget('Heal_Ranks', 0),
    'Heal_Racial' => get_val_from_postget('Heal_Racial', 0),
    'Heal_Feats' => get_val_from_postget('Heal_Feats', 0),
    'Heal_Misc' => get_val_from_postget('Heal_Misc', 0),
    'Intim_Ranks' => get_val_from_postget('Intim_Ranks', 0),
    'Intim_Racial' => get_val_from_postget('Intim_Racial', 0),
    'Intim_Feats' => get_val_from_postget('Intim_Feats', 0),
    'Intim_Misc' => get_val_from_postget('Intim_Misc', 0),
    'Karca_Ranks' => get_val_from_postget('Karca_Ranks', 0),
    'Karca_Racial' => get_val_from_postget('Karca_Racial', 0),
    'Karca_Feats' => get_val_from_postget('Karca_Feats', 0),
    'Karca_Misc' => get_val_from_postget('Karca_Misc', 0),
    'Kdung_Ranks' => get_val_from_postget('Kdung_Ranks', 0),
    'Kdung_Racial' => get_val_from_postget('Kdung_Racial', 0),
    'Kdung_Feats' => get_val_from_postget('Kdung_Feats', 0),
    'Kdung_Misc' => get_val_from_postget('Kdung_Misc', 0),
    'Kengi_Ranks' => get_val_from_postget('Kengi_Ranks', 0),
    'Kengi_Racial' => get_val_from_postget('Kengi_Racial', 0),
    'Kengi_Feats' => get_val_from_postget('Kengi_Feats', 0),
    'Kengi_Misc' => get_val_from_postget('Kengi_Misc', 0),
    'Kgeog_Ranks' => get_val_from_postget('Kgeog_Ranks', 0),
    'Kgeog_Racial' => get_val_from_postget('Kgeog_Racial', 0),
    'Kgeog_Feats' => get_val_from_postget('Kgeog_Feats', 0),
    'Kgeog_Misc' => get_val_from_postget('Kgeog_Misc', 0),
    'Khist_Ranks' => get_val_from_postget('Khist_Ranks', 0),
    'Khist_Racial' => get_val_from_postget('Khist_Racial', 0),
    'Khist_Feats' => get_val_from_postget('Khist_Feats', 0),
    'Khist_Misc' => get_val_from_postget('Khist_Misc', 0),
    'Kloca_Ranks' => get_val_from_postget('Kloca_Ranks', 0),
    'Kloca_Racial' => get_val_from_postget('Kloca_Racial', 0),
    'Kloca_Feats' => get_val_from_postget('Kloca_Feats', 0),
    'Kloca_Misc' => get_val_from_postget('Kloca_Misc', 0),
    'Knatu_Ranks' => get_val_from_postget('Knatu_Ranks', 0),
    'Knatu_Racial' => get_val_from_postget('Knatu_Racial', 0),
    'Knatu_Feats' => get_val_from_postget('Knatu_Feats', 0),
    'Knatu_Misc' => get_val_from_postget('Knatu_Misc', 0),
    'Knobi_Ranks' => get_val_from_postget('Knobi_Ranks', 0),
    'Knobi_Racial' => get_val_from_postget('Knobi_Racial', 0),
    'Knobi_Feats' => get_val_from_postget('Knobi_Feats', 0),
    'Knobi_Misc' => get_val_from_postget('Knobi_Misc', 0),
    'Kplan_Ranks' => get_val_from_postget('Kplan_Ranks', 0),
    'Kplan_Racial' => get_val_from_postget('Kplan_Racial', 0),
    'Kplan_Feats' => get_val_from_postget('Kplan_Feats', 0),
    'Kplan_Misc' => get_val_from_postget('Kplan_Misc', 0),
    'Kreli_Ranks' => get_val_from_postget('Kreli_Ranks', 0),
    'Kreli_Racial' => get_val_from_postget('Kreli_Racial', 0),
    'Kreli_Feats' => get_val_from_postget('Kreli_Feats', 0),
    'Kreli_Misc' => get_val_from_postget('Kreli_Misc', 0),
    'Lingu_Ranks' => get_val_from_postget('Lingu_Ranks', 0),
    'Lingu_Racial' => get_val_from_postget('Lingu_Racial', 0),
    'Lingu_Feats' => get_val_from_postget('Lingu_Feats', 0),
    'Lingu_Misc' => get_val_from_postget('Lingu_Misc', 0),
    'Perce_Ranks' => get_val_from_postget('Perce_Ranks', 0),
    'Perce_Racial' => get_val_from_postget('Perce_Racial', 0),
    'Perce_Feats' => get_val_from_postget('Perce_Feats', 0),
    'Perce_Misc' => get_val_from_postget('Perce_Misc', 0),
    'Perfo_Ranks' => get_val_from_postget('Perfo_Ranks', 0),
    'Perfo_Racial' => get_val_from_postget('Perfo_Racial', 0),
    'Perfo_Feats' => get_val_from_postget('Perfo_Feats', 0),
    'Perfo_Misc' => get_val_from_postget('Perfo_Misc', 0),
    'Profe_Ranks' => get_val_from_postget('Profe_Ranks', 0),
    'Profe_Racial' => get_val_from_postget('Profe_Racial', 0),
    'Profe_Feats' => get_val_from_postget('Profe_Feats', 0),
    'Profe_Misc' => get_val_from_postget('Profe_Misc', 0),
    'Ride_Ranks' => get_val_from_postget('Ride_Ranks', 0),
    'Ride_Racial' => get_val_from_postget('Ride_Racial', 0),
    'Ride_Feats' => get_val_from_postget('Ride_Feats', 0),
    'Ride_Misc' => get_val_from_postget('Ride_Misc', 0),
    'Senmo_Ranks' => get_val_from_postget('Senmo_Ranks', 0),
    'Senmo_Racial' => get_val_from_postget('Senmo_Racial', 0),
    'Senmo_Feats' => get_val_from_postget('Senmo_Feats', 0),
    'Senmo_Misc' => get_val_from_postget('Senmo_Misc', 0),
    'SOH_Ranks' => get_val_from_postget('SOH_Ranks', 0),
    'SOH_Racial' => get_val_from_postget('SOH_Racial', 0),
    'SOH_Feats' => get_val_from_postget('SOH_Feats', 0),
    'SOH_Misc' => get_val_from_postget('SOH_Misc', 0),
    'Spcft_Ranks' => get_val_from_postget('Spcft_Ranks', 0),
    'Spcft_Racial' => get_val_from_postget('Spcft_Racial', 0),
    'Spcft_Feats' => get_val_from_postget('Spcft_Feats', 0),
    'Spcft_Misc' => get_val_from_postget('Spcft_Misc', 0),
    'Stlth_Ranks' => get_val_from_postget('Stlth_Ranks', 0),
    'Stlth_Racial' => get_val_from_postget('Stlth_Racial', 0),
    'Stlth_Feats' => get_val_from_postget('Stlth_Feats', 0),
    'Stlth_Misc' => get_val_from_postget('Stlth_Misc', 0),
    'Survi_Ranks' => get_val_from_postget('Survi_Ranks', 0),
    'Survi_Racial' => get_val_from_postget('Survi_Racial', 0),
    'Survi_Feats' => get_val_from_postget('Survi_Feats', 0),
    'Survi_Misc' => get_val_from_postget('Survi_Misc', 0),
    'Swim_Ranks' => get_val_from_postget('Swim_Ranks', 0),
    'Swim_Racial' => get_val_from_postget('Swim_Racial', 0),
    'Swim_Feats' => get_val_from_postget('Swim_Feats', 0),
    'Swim_Misc' => get_val_from_postget('Swim_Misc', 0),
    'Umdev_Ranks' => get_val_from_postget('Umdev_Ranks', 0),
    'Umdev_Racial' => get_val_from_postget('Umdev_Racial', 0),
    'Umdev_Feats' => get_val_from_postget('Umdev_Feats', 0),
    'Umdev_Misc' => get_val_from_postget('Umdev_Misc', 0)
];

if (isset($user_message)) {
    echo '<p>' . $user_message . '</p>';
}
?>

<form action="." method="post">

    <?php include './view/npc_sheet.php'; ?>

    <input type="hidden" name="action" value="submit-character">
    <input type="submit" value="SAVE NEW CHARACTER">
</form>
<form action="." method="post">
    <input type="hidden" name="action" value="view-characters">
    <input type="submit" value="Cancel">
</form>
