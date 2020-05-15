/*Gallery qui appartiennent a un utlisateur*/
SELECT g.id_Gallery,g.name_Gallery
FROM GALLERY g,USER u
WHERE g.owner_Gallery = u.id_User
AND u.id_User = 2;


/*Membre qui ne sont pas admin*/
SELECT u.id_User,u.login_User
FROM GALLERY g, MEMBER m,USER u
WHERE g.id_Gallery = m.id_Gallery
AND m.id_User = u.id_User
AND g.id_Gallery = 2
AND u.id_User NOT IN (	SELECT usr.id_User
						FROM GALLERY gal,USER usr
						WHERE gal.owner_Gallery = usr.id_User
						AND gal.id_Gallery =2);

/*Gallery d'un user ou il n'est pas admin*/
SELECT g.id_Gallery,g.name_Gallery
FROM GALLERY g, MEMBER m,USER u
WHERE g.id_Gallery = m.id_Gallery
AND m.id_User = u.id_User
AND u.id_User = 2
AND g.id_Gallery NOT IN (	SELECT g.id_Gallery
							FROM GALLERY g,USER u
							WHERE g.owner_Gallery = u.id_User
							AND u.id_User = 2);

/*Number of post*/
SELECT count(*) as NbPost
FROM POST p
WHERE p.publisher_Post = 2

/*Number of gallery*/