Feature:
    In order to ajouter un produit à mon site
    As l’administrateur du site
    I want to ajouter un produit

    Scenario: Je me connecte
        Given Le compte a comme identifiant "admin"
        Given Le compte a comme mot de passe "rootroot"
        When Je donne l’identifiant "admin"
        When Je donne le mot de passe "rootroot"
        Then Je suis donc connecté en administrateur

    Scenario: J’ajoute un produit
        Given Je suis connecté en administrateur
        When J’ajoute le produit "Orangina"
        Then Le produit "Orangina" a été ajouté

# Feature:
#     In order to supprimer un produit à mon site
#     As l’administrateur du site
#     I want to supprimer un produit

#     Scenario: Je me connecte
#         Given Le compte a comme identifiant "admin"
#         Given Le compte a comme mot de passe "root"
#         When Je donne l’identifiant "admin"
#         When Je donne le mot de passe "root"
#         Then Je suis donc connecté en administrateur

#     Scenario: Je supprime un produit
#         Given Je suis connecté en "administrateur"
#         When Je supprime le produit "Orangina"
#         Then Le produit "Orangina" a été supprimé

# Feature:
#     In order to modifier un produit à mon site
#     As l’administrateur du site
#     I want to modifier un produit

#     Scenario: Je me connecte
#         Given Le compte a comme identifiant "admin"
#         Given Le compte a comme mot de passe "root"
#         When Je donne l’identifiant "admin"
#         When Je donne le mot de passe "root"
#         Then Je suis donc connecté en administrateur

#     Scenario: Je modifie un produit
#         Given Je suis connecté en "administrateur"
#         When Je modifie le produit "Orangina"
#         Then Le produit "Orangina" a été modifié

# Feature:
#     In order to ajouter un produit à mon site
#     As utilisateur
#     I want to être sûr qu'on ne peut ajouter un produit sans le rôle administrateur

#     Scenario: Je me connecte
#         Given Le compte a comme identifiant "user"
#         Given Le compte a comme mot de passe "root"
#         When Je donne l’identifiant "user"
#         When Je donne le mot de passe "root"
#         Then Je suis donc connecté en utilisateur

#     Scenario: J'essaye d'ajouter un produit sans être administrateur
#         Given Je suis connecté en "utilisateur"
#         When J’ajoute le produit "Orangina"
#         Then Le produit "Orangina" n'a pas pu être ajouté

# Feature:
#     In order to me connecter
#     As utilisateur
#     I want to me connecter

#     Scenario: Je me connecte
#         Given Le compte a comme identifiant "user"
#         Given Le compte a comme mot de passe "root"
#         When Je donne l’identifiant "user"
#         When Je donne le mot de passe "root"
#         Then Je suis donc connecté en utilisateur


# Feature:
#     In order to me déconnecter
#     As utilisateur
#     I want to me déconnecter

#     Scenario: Je me déconnecte
#         Given Je suis connecté en "utilisateur"
#         When Je me déconnecte
#         Then Je suis déconnecté

# Feature:
#     In order to commander un produit

#     Scenario: Je me connecte
#         Given Le compte a comme identifiant "user"
#         Given Le compte a comme mot de passe "root"
#         When Je donne l’identifiant "user"
#         When Je donne le mot de passe "root"
#         Then Je suis donc connecté en utilisateur

#     Scenario: Je commande un produit
#         Given Je suis connecté en "utilisateur"
#         When Je commande le produit "Orangina"
#         Then Le produit "Orangina" a été commandé

