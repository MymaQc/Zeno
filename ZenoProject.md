# Zeno (zenopractice.ml)
**Premier aperçu du contenu officiel prévu sur le projet Zeno**

_Credit : Myma (Founder) & Zeyroz (Developer)_ 😎

---

## Lobby

**Dans le dossier `PlayerExhaust`, n'oublies pas de bloquer la bouffe du joueur 20 pour qu'il ne soit jamais dans l'obligation de manger pendant un fight**

### Items 

- Slots 2 → Épée en diamant (Duels) [Nom de l'item : `§aJoin Duels`]
- Slots 4 → Boussole (FFA/Arène) [Nom de l'item : `§aFFA`]
- Slots 6 → Émeraude (Events) [Nom de l'item : `§aEvent`]
- Slots 8 → Étoile du nether (Cosmétiques & Mods) [Nom de l'item : `§aCosmetics & Mods`]

### Floating Text

Voici la liste des floating text qui seront présents dans le spawn :

- Floating Text avec les liens de contact (*Discord, Website*)
- Leaderboard Top Kill
- Leaderboard Top Global Elo

Format des leaderboards en floating text

```
§2- §l§aZeno Top ... §r§2-
§21. §fMymaQc §l§2» §r§a312 kills
§22. §fFriteQc §l§2» §r§a284 kills
§23. §fAluzay §l§2» §r§a276 kills
§24. §fZeyrozMC §l§2» §r§a255 kills
§25. §fF5 §l§2» §r§a231 kills
§26. §fTrisMc §l§2» §r§a229 kills
§27. §fMalthay §l§2» §r§a180 kills
§28. §fZarTreyk §l§2» §r§a174 kills
§29. §fKumiiia §l§2» §r§a146 kills
§210. §fTacomile §l§2» §r§a111 kills
```

*Le format en message dans le tchat (lorsque quelqu'un fera la commande `/leaderboard`) sera le même que sur un floating text*

### Scoreboard

Voici brièvement à quoi devrait ressembler le scoreboard du lobby de Zeno

[Aperçu du scoreboard du lobby](https://zupimages.net/viewer.php?id=21/09/w29q.jpg)

| Option | Description |
| ------| -----------|
| rank   | Grade du joueur sur le serveur. |
| online | Nombre de joueurs total en ligne sur le serveur |
| playing    | Nombre de joueurs total jouant dans des arènes (NON OBLIGATOIRE) |
| ping | Nombre de ms que le joueur possède sur le serveur (à mettre à la place de `playing` si nécessaire) |

### Grades

À faire avec le plugin `PurePerms` & `PureChat`

[Aperçu des grades](https://zupimages.net/viewer.php?id=21/09/pq3f.png)

---

## FFA

Voici la liste des modes de jeux à mettre en mode FFA

- NoDebuff (Image : Potion de heal)
- Hive Sumo (Image : Plume)
- Soup KitMap (Image : Soupe)

Combat logger : 25 secondes

Format des boutons du form

[Aperçu en image du format des boutons, mais avec les couleurs ci-dessous](https://zupimages.net/viewer.php?id=21/09/xvd5.jpg)

```
Titre du form : §8FFA

§l§a(MODE DE JEU)
§fCurrently Playing: §2(Nombre de joueurs dans l'arène)
```

### Kits


- Gapple
    + Armure en diamant (Protection 4)
    + Épée en diamant (Sharpness 5)
    + 10 pomme en or
- NoDebuff
    + Armure en diamant (Solidité 10)
    + Épée en diamant (Solidité 10)
    + 16 EnderPearls  
    + Potion de heal 2 dans le reste de l'inventaire
    + Effet de Speed 1 infini
- Debuff
    + Armure en diamant (Solidité 10)
    + Épée en diamant (Solidité 10)
    + 16 EnderPearls
    + 3 potions de lenteur (1:07)
    + 3 potions de poison (0:33)
    + Potion de heal 2 dans le reste de l'inventaire
    + Effet de Speed 1 infini
- Hive Sumo
    + Bottes en maille
    + Effet de Résistance 2 infini
- Soup KitMap
    + Default
        * Armure en diamant (no enchant sauf casque et bottes solidité 1)
        * Épée en diamant (Sharpness 3 & Solidité 3)
        * 6 EnderPearls
        * 64 soupes
        * 4 pommes (effet : Régénération 2 & Absorbtion 2)
    + Star (grade VIP)
        * Armure en diamant (no enchant sauf casque, plastron & bottes solidité 1)
        * Épée en diamant (Sharpness 3 & Solidité 3)
        * 10 EnderPearls
        * 64 soupes
        * 8 pommes (effet : Régénération 2 & Absorbtion 2)
    
NOTE : Les boosters ont accès au kit Star
TODO : /rekit pour pouvoir se rekit avec une commande

---

## Duels

Voici la liste des modes de jeux à mettre en mode Duels

- Gapple (Image : Golden Apple)
- NoDebuff (Image : Potion de heal)
- Debuff (Image : Potion de poison)  
- Sumo (Image : Plume)
- Soup KitMap (Image : Soupe)

(Pour les maps des duels, je te les enverrai en message privé Discord avec les coordonnées de ceux-ci)

---

## Commandes

- /spawn (/hub, /lobby) [Permet de se rendre au spawn]
- /tpall [Téléporter tous les joueurs du serveur à un endroit]  
- /kick [Expulser un joueur]
- /kickall [Expulser tous les joueurs du serveur]
- /restart [Redémarrer le serveur]  
- /ban [Bannir un joueur] & /unban [Débannir un joueur]
- /msg (/w, /tell) [Envoyer un message privé]
- /announce [Faire une annonce sur le serveur]  
- /freeze [Geler un joueur] & /unfreeze [Dégeler un joueur]
- /report [Dénoncer un joueur qui ne respecte pas les règles]  
- /kit (utilisable seulement dans le monde FFA KitMap Soup) [Choisir son kit]  
- /rekit [Permet de se rekit sans retourner au lobby]
- /r (/reply) [Permet de répondre au dernier message privé envoyé]
- /ping [Permet de voir le nombre de MS qu'un joueur ou toi-même possède]
- /stats [Permet de voir les statistiques d'un joueur/ses statistiques]
- /nick (/disguise) [Permet de changer de pseudo sur le serveur]
- /fly (Non-accessible pour les non gradés & utilisable seulement au lobby) [Permet de voler]

---

## Mods

Voici la liste des mods à mettre sur le serveur :

- CPS Mod
- Combo Mod
- Auto Rekit  
- Scoreboard ON/OFF (pouvoir désactiver ou activer le scoreboard)

---

## Boutique

### Grades

- Star (10$)