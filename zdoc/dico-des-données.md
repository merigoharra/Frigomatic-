# Dictionnaire de données

## User (app_user)

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de l'utilisateur|
|firstname|VARCHAR|--|prenom de l'utilisateur|
|lastname|VARCHAR|--|nom de l'utilisateur|
|username|VARCHAR|NOT NULL, UNIQUE|pseudo de l'utilisateur|
|password|VARCHAR|--|mot de passe de l'utilisateur|
|age|INTEGER|--|Age de l'utilisateur|
|email|VARCHAR|NOT NULL, UNIQUE|email de l'utilisateur|
|avatar|VARCHAR|--|avatar de l'utilisateur|
|gender|VARCHAR|--|genre de l'utilisateur
|weight|INTEGER|--|Poids de l'utilisateur|
|height|INTEGER|--|Taille de l'utilisateur|
|is_active|BOOL|NOT NULL, DEFAULT = 1|status de l'utilisateur (actif/bloqué)|
|createdAt|datetime|NOT NULL|date de creation de l'utilisateur|
|updatedAt|datetime|NOT NULL|date de mise à jour de l'utilisateur|

## Role

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du role|
|role|VARCHAR|NOT NULL|nom du role|
|code|VARCHAR|NOT NULL|code du role|
|createdAt|datetime|NOT NULL|date de creation|
|updatedAt|datetime|NOT NULL|date de mise à jour|

## User_Product (Frigo de l'utilisateur)

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant|
|quantity|INTEGER|NOT NULL|quantité de l'ingrédient|
|createdAt|datetime|NOT NULL|date de creation|
|updatedAt|datetime|NOT NULL|date de mise à jour|
|user_id|INT|NOT NULL, FOREIGN KEY| utilisateur associé|
|product_id|INT|NOT NULL, FOREIGN KEY| produit associé|

## Product

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant|
|name|VARCHAR|--|nom du produit|
|measure|VARCHAR|NOT NULL|unité de mesure du produit|
|createdAt|datetime|NOT NULL|date de creation|
|updatedAt|datetime|NOT NULL|date de mise à jour|
|catégory_id|INT|NOT NULL, FOREIGN KEY| catégories aoocié|

## category

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant|
|name|VARCHAR|NOT NULL|nom de la catégorie|
|createdAt|datetime|NOT NULL|date de creation|
|updatedAt|datetime|NOT NULL|date de mise à jour|


## recipe

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant|
|name|VARCHAR|NOT NULL|nom du Game|
|content|TEXT|NOT NULL|description du Game|
|image|VARCHAR|--|image de la recette|
|createdAt|datetime|NOT NULL|date de creation du Game|
|updatedAt|datetime|NOT NULL|date de mise à jour du Game|
|total_duration|INT|NOT NULL|temps de total de la recette|
|prep_duration|INT|NOT NULL|temps de préparation de la recette|
|baking_duration|INT|NOT NULL|temps de cuisson de la recette|
|people|INT|NOT NULL|nombre de personne pour la recette|
|level|INT|NOT NULL|niveau de difiiculté de la recette|
|user_id|INT|NOT NULL|créateur de la recette|


## tag

|Champ|Type|Spécificités|Description|
|--|--|--|--|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant|
|name|VARCHAR|NOT NULL|nom du tag|
|createdAt|datetime|NOT NULL|date de creation|
|updatedAt|datetime|NOT NULL|date de mise à jour|