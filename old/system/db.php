<?php
$mongo = new MongoClient();

$users_db = $mongo->chipopo->users;
$users_db->ensureIndex(array('email' => 1), array('unique' => true));

$items_db = $mongo->chipopo->items;
$pastes_db = $mongo->chipopo->pastes;
$buyit2_db = $mongo->chipopo->buyit2;
$comments_db = $mongo->chipopo->comments;
$profilePics_db = $mongo->chipopo->profilePics;
$wishlist_db = $mongo->chipopo->wishlist;
$currencies_db = $mongo->chipopo->currencies;
$pms_db = $mongo->chipopo->pms;
$redirects_db = $mongo->chipopo->redirects;
$relationship_db = $mongo->chipopo->relationship;

############### ADMIN DB ##############
$categories_db = $mongo->chipopo->categories;
############### ADMIN DB ##############


?>