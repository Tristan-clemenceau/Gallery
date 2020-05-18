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

/*Number member of gallery*/
SELECT m.id_Gallery,MAX(m.id_User) as MaxUser
FROM member m
WHERE m.id_Gallery IN(	SELECT g.id_Gallery
						FROM GALLERY g,USER u
						WHERE g.owner_Gallery = u.id_User
						AND u.id_User = 1)
GROUP By m.id_Gallery
limit 1;

/*Number member of gallery*/
SELECT m.id_Gallery,COUNT(m.id_User) as nbUser
FROM member m
GROUP By m.id_Gallery

/*Get all member form a gallery*/
SELECT u.id_User,u.login_User
FROM MEMBER m, USER u
WHERE m.id_User = u.id_User
AND m.id_Gallery = 2;

/*GET POST BY ID MEMBER AND GALLERY*/
SELECT i.id_Image,i.link_Image,p.id_Post,p.description_Post
FROM IMAGE i, POST p
WHERE i.id_Image = p.id_Image
AND p.publisher_Post = 1

/*VERIFIER SI MEMBRE EST DANS LA GALLERIE*/
SELECT m.id_User
FROM  MEMBER m
WHERE m.id_Gallery = (
	SELECT p.id_Gallery
	FROM POST p
	WHERE p.id_Post = 1)
AND m.id_User = 1;

/*GET IMAGE ID WITH A POST*/
SELECT p.id_Image
FROM POST p
WHERE p.id_Post = 1

/*GET IFORMATION FROM IMAGE*/
SELECT i.link_Image
FROM IMAGE i
WHERE i.id_Image = 1