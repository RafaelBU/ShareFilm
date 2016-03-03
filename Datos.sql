INSERT INTO `usuarios` (`Nick`, `Password`, `Nombre`, `Apellidos`, `Pais`, `Ciudad`, `Mail`, `Avatar`, `admin`) VALUES
('Admin', '$2y$10$IWLBAYzJ.helxbjxN7kPieufrjKxLRZEO7UMVqFEHFlMI3SOnxGSu', 'admin', 'admin', 'admin', 'admin', 'admin@sharefilm.com', '', 1),
('jairo', '$2y$10$f0r4kxjEwnInarQjV0U53u7adrj73nqp76M4EeStm5bSZ8BpDZ6B6', 'Jairo', 'Marquez', 'Peru', 'Paramonga', 'jairo@paramonga.com', 'img/Avatares/usuarioTrans.png', 0),
('Pablo', '$2y$10$Ks64T63VHMrvRCEZQAenPOFwYGrC/rHxIaBO068bE.v62rkUcugr2', 'Pablo', 'Grado', 'España', 'Madrid', 'pablofergra@hotmail.com', 'img/Avatares/Pablo', 0),
('rafa', '$2y$10$JeiY17WanePmGvKL.CQXq.tl2Fu3P/Cm47OVJENbNxsHHoXejV22u', 'Rafa', 'Buzon', 'España', 'Madrid', 'rafa@ucm.es', 'img/Avatares/usuarioTrans.png', 0);


INSERT INTO `genero` (`Tipo`, `Id`) VALUES
('Accion', 1),
('Ciencia ficcion', 2),
('Comedia', 3),
('Documental', 4),
('Drama', 5),
('Historica', 6),
('Infantil', 7),
('Misterio', 8),
('Musical', 9),
('Romantica', 10),
('Suspense', 11),
('Terror', 12);


INSERT INTO `historial` (`nick`, `fecha`, `accion`, `texto`) VALUES
('jairo', '2015-05-28 12:03:49', 'escrito', 'La adaptación de ‘It’ habría vuelto a Warner Bros'),
('jairo', '2015-05-28 14:32:34', 'valorado', 'Cadena Perpetua'),
('Jairo', '2015-05-28 15:05:29', 'valorado', 'A todo gas 7'),
('Jairo', '2015-05-28 15:05:41', 'valorado', 'Pesadilla en Elm Street'),
('Jairo', '2015-05-28 15:11:56', 'comentado', 'Un nuevo arte conceptual de Wonder Woman'),
('Jairo', '2015-05-28 16:02:03', 'seguido', 'a jairo'),
('Pablo', '2015-05-28 11:56:11', 'seguido', 'a jairo'),
('Pablo', '2015-05-28 11:57:19', 'comentado', 'Chris Pine está en conversaciones para ser Steve Trevor en ‘Wonder Woman’'),
('Pablo', '2015-05-28 12:07:35', 'escrito', 'Tilda Swinton podría ser The Ancient One en ‘Doctor Strange’\r\n'),
('Pablo', '2015-05-28 14:51:10', 'valorado', 'Seven'),
('Pablo', '2015-05-28 15:34:21', 'comentado', 'Un nuevo arte conceptual de Wonder Woman'),
('Pablo', '2015-05-28 15:47:22', 'comentado', 'Un nuevo arte conceptual de Wonder Woman'),
('rafa', '2015-05-28 12:13:28', 'escrito', 'Un nuevo arte conceptual de Wonder Woman'),
('rafa', '2015-05-28 12:14:30', 'seguido', 'a jairo'),
('rafa', '2015-05-28 12:14:32', 'seguido', 'a Pablo'),
('rafa', '2015-05-28 15:51:52', 'comentado', 'Un nuevo arte conceptual de Wonder Woman'),
('rafa', '2015-05-28 15:53:52', 'valorado', 'Pesadilla en Elm Street'),
('rafa', '2015-05-28 15:54:37', 'comentado', 'Un nuevo arte conceptual de Wonder Woman');


INSERT INTO `noticias` (`ID`, `Titulo`, `Cabecera`, `Nick`, `Fecha`, `Contenido`, `Foto`) VALUES
(4, 'Chris Pine está en conversaciones para ser Steve Trevor en ‘Wonder Woman’', 'Warner Bros. ya estaría negociando con el actor para sumarlo a su nuevo universo de superhéroes.', 'jairo', '2015-05-28 11:28:14', 'Varios rumores se han reportado sobre Steve Trevor, el clásico interés amoroso de Wonder Woman, de cara a su eventual traspaso a la pantalla grande. El más recurrente: que quizás aparezca en The Suicide Squad. Pero aquello ahora solo queda en el ámbito del rumor, ya que Variety está reportando que Chris Pine, el nuevo capitán Kirk en el reinicio de Star Trek, está en conversaciones para asumir el rol en la película que dirigirá Patty Jenkins.\r\n\r\nEl personaje en todo caso hace rato que no es un mero comparsa, ya que en los últimos años han abordado su lado militar para sumarlo a otros grupos del universo DC. Ahí tienen a A.R.G.U.S. o Team 7 en Los Nuevos 52.\r\n\r\nPero por ahora no está claro qué clase de rol tendrá, pero en la versión clásica, Trevor es un soldado de Estados Unidos que llega  la Isla Paraíso tras un accidente. A partir de ahí establece el primer contacto de Wonder Woman con el mundo exterior.\r\n\r\nVolviendo a un punto anterior, en Variety explicaron que Scott Eastwood tuvo sobre la mesa dos opciones: un rol secundario en Suicide Squad o la posibilidad de ser parte de las pruebas para el rol de Trevor. El actor se fue a la segura eligiendo la primera ruta, lo que quizás generó aquellos rumores sobre la aparición de Trevor en The Suicide Squad. De ahí que eso habría sido una mera especulación de aquellos que reportaron la información en primer lugar.', 'img/Noticias/chris-pine1.png'),
(5, 'La adaptación de ‘It’ habría vuelto a Warner Bros', 'Tras la salida de Cary Fukunaga como director, la casa matriz habría tomado el control de la adaptación para dar más presupuesto.', 'jairo', '2015-05-28 12:03:49', 'Desde Bloody-Disguting informaron que la adaptación de It, que parecía muerta tras la salida de Cary Fukunaga (True Detective), comenzó a ganar nuevamente fuerza. Tras los problemas en su subsidiaria New Line, el proyecto habría retornado a Warner Bros. No solo eso, en el sitio afirman que eso implicará un incremento del presupuesto que permitirá que la película sea filmada en Nueva York tal como quería Fukunaga.\r\n\r\nNo obstante, en el estudio ya están buscando a un nuevo director y de acuerdo a su fuente, ya se están reuniendo con los candidatos para decidir al elegido en las próximas semanas. De ahí que especulan que los recortes de presupuesto simplemente habrían sido una excusa para ocultar otro tipo de diferencia creativa con Fukunaga.\r\n\r\nEl sitio agrega que la película seguirá adelante con los guiones que ya escribió Fukunaga y que las filmaciones comenzarán este año, tal y como estaba contemplado originalmente. De este modo esta adaptación del clásico de terror de Stephen King mantendrá la idea de concretarse en dos películas, con la primera centrándose en la infancia de los protagonistas y la segunda parte abordando su encuentro definitivo con el payaso Pennywise.\r\n\r\nPor ahora habrá que esperar para ver si este reporte está en lo correcto, pero perdí bastante entusiasmo con lo que pasó en la última semana. Ciertamente.', 'img/Noticias/it1.png'),
(6, 'Tilda Swinton podría ser The Ancient One en ‘Doctor Strange’\r\n', 'Marvel Studios apunta a lo grande con el elenco de esta película.\r\n', 'Pablo', '2015-05-28 12:07:35', 'El elenco de Doctor Strange se prepara para incrementarse tras la confirmación de Benedict Cumberbatch para el rol principal. Ahora The Hollywood Reporter informó que la gran Tilda Swinton está negociando para sumarse al universo de Marvel Studios. Si las conversaciones llegan a buen puerto, su rol será el de The Ancient One. Y es en este punto en el que los llantos se multiplican, ya que el personaje en los cómics es un hombre.\r\n', 'img/Noticias/swinton.png'),
(7, 'Un nuevo arte conceptual de Wonder Woman', 'Gal Gadot interpretará a la amazona que debutará en Batman v. Superman.', 'rafa', '2015-05-28 12:13:28', 'En Heroichollywood, que será el nuevo sitio de El Mayimbe de Latino-Review, presentaron un nuevo arte conceptual de la versión de Wonder Woman que debutará en Batman v Superman: Dawn of Justice.\r\n\r\nProbablemente el siguiente es el mejor vistazo a la fecha del diseño de la amazona, que será interpretada por Gal Gador. Pero aún así seguimos a la espera de una nueva imagen oficial, ya que la última foto la presentaron durante la pasada Comic-Con de San Diego. Una imagen que, como todo lo que tiene la marca Snyder, tenía los colores demasiado opacos.', 'img/Noticias/wonder-woman1.jpg');

INSERT INTO `comentario` (`Fecha`, `Nick`, `IdNoticia`, `Coment`) VALUES
('2015-05-28 11:57:19', 'Pablo', 4, 'Me gusta mucho esta peli'),
('2015-05-28 15:11:56', 'Jairo', 7, 'Creo que no es buena actriz para este papel.'),
('2015-05-28 15:31:43', 'Jairo', 7, 'Muy buen aporte por cierto!'),
('2015-05-28 15:32:30', 'Jairo', 7, 'abc'),
('2015-05-28 15:34:21', 'Pablo', 7, 'Yo opino igual que Jairo'),
('2015-05-28 15:34:48', 'Pablo', 7, 'pero bueno..'),
('2015-05-28 15:41:14', 'Pablo', 7, 'jejeje'),
('2015-05-28 15:47:22', 'Pablo', 7, 'heeey'),
('2015-05-28 15:51:52', 'rafa', 7, 'holaaa '),
('2015-05-28 15:54:37', 'rafa', 7, 'heyyy');

INSERT INTO `peliculas` (`ID`, `Titulo`, `Director`, `Actores`, `Sinopsis`, `Portada`) VALUES
(11, 'Cadena Perpetua', 'Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton, James Whi', 'Acusado del asesinato de su mujer, Andrew Dufresne (Tim Robbins), tras ser condenado a cadena perpetua, es enviado a la cárcel de Shawshank. Con el paso de los años conseguirá ganarse la confianza del director del centro y el respeto de sus compañeros de prisión, especialmente de Red (Morgan Freeman), el jefe de la mafia de los sobornos', 'img/Peliculas/cadena.jpg'),
(12, 'A todo gas 7', 'James Wan', 'Vin Diesel, Paul Walker, Jason Statham', 'Ha pasado un año desde que el equipo de Dominic Torreto y Brian pudiera regresar finalmente a Estados Unidos, tras ser indultados. Desean adaptarse a una vida en la legalidad, pero el entorno ya no es el mismo. Dom intenta acercarse a Letty, y Brian lucha para acostumbrarse a la vida en una urbanización con Mia y su hijo. Ninguno de ellos imagina que un frío asesino británico, entrenado para realizar operaciones secretas, se cruzará en sus vidas para convertirse en su mayor enemigo.', 'img/Peliculas/a_todo_gas_7.jpg'),
(14, 'Vengadores: La era de Ultrón', 'Joss Whedon', 'Robert Downey Jr., Chris Evans, Chris Hemsworth', 'Cuando Tony Stark intenta reactivar un programa caído en desuso cuyo objetivo es mantener la paz, las cosas empiezan a torcerse y los héroes más poderosos de la Tierra, incluyendo a Iron Man, Capitán América, Thor, El Increíble Hulk, Viuda Negra y Ojo de Halcón, tendrán que afrontar la prueba definitiva cuando el destino del planeta se ponga en juego. Cuando el villano Ultrón emerge, le corresponderá a Los Vengadores detener sus terribles planes, que junto a incómodas alianzas llevarán a una inesperada acción que allanará el camino para una épica y única aventura. ', 'img/Peliculas/la_era_de_ultron.jpg'),
(15, 'Seven', 'David Fincher', 'Brad Pitt, Morgan Freeman, Gwyneth Paltrow, Kevin ', 'El veterano teniente Somerset (Morgan Freeman), del departamento de homicidios, está a punto de jubilarse y ser reemplazado por el ambicioso e impulsivo detective David Mills (Brad Pitt). Ambos tendrán que colaborar en la resolución de una serie de asesinatos cometidos por un psicópata que toma como base la relación de los siete pecados capitales: gula, pereza, soberbia, avaricia, envidia, lujuria e ira. ', 'img/Peliculas/seven.jpg'),
(16, 'Sherlock Holmes', 'Guy Ritchie', 'Robert Downey Jr., Jude Law, Rachel McAdams, Mark ', 'Sherlock Holmes y su incondicional compañero Watson, deberán usar su agudeza intelectual y toda clase de recursos y habilidades para enfrentarse a un nuevo enemigo y desenmarañar un complot que podría destruir el país. Adaptación del cómic de Lionel Wigram, que reinventa los personajes de Arthur Conan Doyle, convirtiendo a Sherlock Holmes (Robert Downey Jr.) y al Doctor John Watson (Jude Law) en detectives con habilidades para el boxeo y la esgrima respectivamente. ', 'img/Peliculas/Sherlock_Holmes.jpg'),
(17, 'Pesadilla en Elm Street', 'Wes Craven', 'Heather Langenkamp, Robert Englund, Johnny Depp, J', 'Varios jóvenes de una pequeña localidad tienen habitualmente pesadillas en las que son perseguidos por un hombre deformado por el fuego y que usa un guante terminado en afiladas cuchillas. Algunos de ellos comienzan a ser asesinados mientras duermen por este ser, que resulta ser un asesino al que los padres de estos jóvenes quemaron vivo hace varios años tras descubrir que había asesinado a varios niños.', 'img/Peliculas/pesadilla_elm_street.jpg'),
(18, 'Love Actually', 'Richard Curtis', 'Hugh Grant, Liam Neeson, Colin Firth, Laura Linney', 'En Londres, poco antes de las Navidades, se entrelazan una serie de historias divertidas y conmovedoras. "Love, Actually" es una manera abreviada de decir “Love Actually Is All Around” y éste es precisamente el argumento de la película: mires a donde mires, encontrarás el amor en todas partes. Todos los personajes, cada uno a su manera (un primer ministro, una vieja estrella del rock, una asistenta portuguesa que sólo habla su idioma), están relacionados con los aspectos más divertidos, tristes, ingenuos y estúpidos del amor.', 'img/Peliculas/lovel_actually.jpg'),
(19, 'Los miserables', 'Tom Hooper', 'Hugh Jackman, Russell Crowe, Anne Hathaway', 'El expresidiario Jean Valjean (Hugh Jackman) es perseguido durante décadas por el despiadado policía Javert (Russell Crowe). Cuando Valjean decide hacerse cargo de Cosette, la pequeña hija de Fantine (Anne Hathaway), sus vidas cambiarán para siempre. Adaptación cinematográfica del famoso musical ''Les miserables'', basado a su vez en la novela homónima de Victor Hugo.', 'img/Peliculas/los_miserables.jpg'),
(20, 'Cosmos: A Space-Time Odyssey', 'Ann Druyan', 'Documentary, Neil deGrasse Tyson', 'Más de 30 años después de que Carl Sagan buscase los límites del universo y del hombre a través de la ciencia, COSMOS: A SPACE-TIME ODYSSEY propone un nuevo viaje hacia las estrellas. Presentado por el prestigioso astrofísico Neil deGrasse Tyson, esta continuación explora cómo descubrimos las leyes de la naturaleza y encontramos nuestro lugar en el tiempo y el espacio.', 'img/Peliculas/cosmos.jpg'),
(21, 'Toy Story 3', 'Lee Unkrich', 'Animation', 'Cuando su dueño Andy se prepara para ir a la universidad, el vaquero Woody, el astronauta Buzz y el resto de sus amigos juguetes comienzan a preocuparse por su incierto futuro. Efectivamente todos acaban en una guardería, donde por ejemplo la muñeca Barbie conocerá al guapo Ken. Esta reunión de nuestros amigos con otros nuevos juguetes no será sino el principio de una serie de trepidantes y divertidas aventuras.', 'img/Peliculas/Toy_Story_3.jpg'),
(22, 'Up', 'Pete Docter', 'Animation', 'Carl Fredricksen es un viudo vendedor de globos de 78 años que, finalmente, consigue llevar a cabo el sueño de su vida: enganchar miles de globos a su casa y salir volando rumbo a América del Sur. Pero ya estando en el aire y sin posibilidad de retornar Carl descubre que viaja acompañado de Russell, un explorador que tiene ocho años y un optimismo a prueba de bomba.', 'img/Peliculas/up.jpg'),
(23, 'WALL•E', 'Andrew Stanton', 'Animation, Fred Willard', 'En el año 2800, en un planeta Tierra devastado y sin vida, tras cientos de solitarios años haciendo aquello para lo que fue construido -limpiar el planeta de basura- el pequeño robot WALL•E (acrónimo de Waste Allocation Load Lifter Earth-Class) descubre una nueva misión en su vida (además de recolectar cosas inservibles) cuando se encuentra con una moderna y lustrosa robot exploradora llamada EVE. Ambos viajarán a lo largo de la galaxia y vivirán una emocionante e inolvidable aventura.', 'img/Peliculas/wall_e.jpg'),
(24, 'Alien, el octavo pasajero', 'Riddle Scott', 'Sigourney Weaver, John Hurt, Yaphet Kotto, Tom Ske', 'De regreso a la Tierra, la nave de carga Nostromo interrumpe su viaje y despierta a sus siete tripulantes. El ordenador central, MADRE, ha detectado la misteriosa transmisión de una forma de vida desconocida, procedente de un planeta cercano aparentemente deshabitado. La nave se dirige entonces al extraño planeta para investigar el origen de la comunicación.', 'img/Peliculas/alien_el_octavo.jpg'),
(25, 'Troya', 'Wolfgang Petersen', 'Brad Pitt, Eric Bana, Orlando Bloom, Brian Cox, Pe', 'En el año 1193 a. C., Paris (Orlando Bloom), hijo de Príamo y príncipe de Troya, rapta a Helena (Diane Kruger), esposa de Menelao, el rey de Esparta, lo que desencadena la Guerra De Troya, en la que se enfrentan griegos y troyanos. El ejército griego asedió la ciudad de Troya durante más de diez años. Aquiles (Brad Pitt) era el gran héroe de los griegos, mientras Héctor (Eric Bana), el hijo mayor de Príamo (Peter O''Toole), el rey de Troya, representaba la única esperanza de salvación para la ciudad.', 'img/Peliculas/troya.jpg'),
(26, 'Mystic River', 'Clint Eastwood', 'Sean Penn, Tim Robbins, Kevin Bacon, Laurence Fish', 'Cuando Jimmy Markum (Sean Penn), Dave Boyle (Tim Robbins) y Sean Devine (Kevin Bacon) eran unos niños que crecían juntos en un peligroso barrio obrero de Boston, pasaban los días jugando al hockey en la calle. Pero, un día, a Dave le ocurrió algo que marcó para siempre su vida y la de sus amigos. Veinticinco años más tarde, otra tragedia los vuelve a unir: el asesinato de Katie (Emmy Rossum), la hija de 19 años de Jimmy. A Sean, que es policía, le asignan el caso; pero también tiene que estar muy pendiente de Jimmy porque, en su desesperación, está intentando tomarse la justicia por su mano.', 'img/Peliculas/Mistic.jpg'),
(27, 'El orfanato', 'Juan Antonio Bayona', 'Belén Rueda, Fernando Cayo, Géraldine Chaplin', 'Laura se instala con su familia en el orfanato en el que creció de niña. Su propósito es abrir una residencia para niños discapacitados. El ambiente del viejo caserón despierta la imaginación de su hijo, que empieza a dejarse arrastrar por la fantasía. Los juegos del niño inquietan cada vez más a Laura, que empieza a sospechar que en la casa hay algo que amenaza su familia.', 'img/Peliculas/el_orfanato.jpg'),
(28, 'Poltergeist', 'Tobe Hooper', 'JoBeth Williams, Craig T. Nelson, Beatrice Straigh', 'Una familia americana de clase media se traslada a vivir a un idílico barrio, pero dentro de la casa empiezan a suceder cosas extrañas, fenómenos paranormales para los que no hay explicación posible.', 'img/Peliculas/Poltergeist.jpg'),
(29, 'Moulin Rouge', 'Baz Luhrmann', 'Nicole Kidman, Ewan McGregor, John Leguizamo', 'Ambientada en el París bohemio de 1900. Satine, la estrella más rutilante del Moulin Rouge, encandila a toda la ciudad con sus bailes llenos de sensualidad y su enorme belleza. Atrapada entre el amor de dos hombres, un joven escritor y un duque, lucha por hacer realidad su sueño de convertirse en actriz. Pero, en un mundo en el que todo vale, excepto enamorarse, nada es fácil. ', 'img/Peliculas/Moulin_Rouge.jpg'),
(30, 'Celda 211', 'Daniel Monzón', 'Luis Tosar, Alberto Ammann, Antonio Resines', 'El día en que Juan (Alberto Ammann) empieza a trabajar en su nuevo destino como funcionario de prisiones, se ve atrapado en un motín carcelario. Decide entonces hacerse pasar por un preso más para salvar su vida y para poner fin a la revuelta, encabezada por el temible Malamadre (Luis Tosar). Lo que ignora es que el destino le ha preparado una encerrona.', 'img/Peliculas/Celda_211.jpg'),
(31, 'Mientras duermes', 'Jaume Balagueró', 'Luis Tosar, Marta Etura, Alberto San Juan', 'César es el portero de un edificio de apartamentos y no cambiaría este trabajo por ningún otro, ya que le permite conocer a fondo los movimientos, los hábitos más íntimos, los puntos débiles y los secretos de todos los inquilinos. Si quisiera podría incluso controlar sus vidas, influir en ellas como si fuera Dios, abrir sus heridas y hurgar en ellas. Y todo sin levantar ninguna sospecha. Porque César guarda un secreto muy peculiar: le gusta hacer daño, mover las piezas necesarias para producir dolor a su alrededor.', 'img/Peliculas/Mientras_duermes-772499751-large.jpg'),
(32, 'Ocho apellidos vascos', 'Emilio Martínez-Lázaro', 'Dani Rovira, Clara Lago, Carmen Machi, Karra Elejalde, Alfonso Sánchez', 'Rafa (Dani Rovira) es un joven señorito andaluz que no ha tenido que salir jamás de su Sevilla natal para conseguir lo único que le importa en la vida: el fino, la gomina, el Betis y las mujeres. Todo cambia cuando conoce una mujer que se resiste a sus encantos: es Amaia (Clara Lago), una chica vasca. Decidido a conquistarla, se traslada a un pueblo de las Vascongadas, donde se hace pasar por vasco para vencer su resistencia.', 'img/Peliculas/Ocho_apellidos_vascos.png');


INSERT INTO `tienegeneropeli` (`IdPeli`, `Genero`) VALUES
(12, 1),
(14, 1),
(24, 2),
(32, 3),
(20, 4),
(11, 5),
(30, 5),
(25, 6),
(21, 7),
(22, 7),
(23, 7),
(16, 8),
(19, 9),
(29, 9),
(18, 10),
(15, 11),
(26, 11),
(31, 11),
(17, 12),
(28, 12);


INSERT INTO `peliculatienda` (`ID`, `Titulo`, `Portada`, `Trailer`, `numeroVentas`) VALUES
(1, 'El legado de Bourne', 'img/Tienda/elLegadoDeBourne.png', 'https://www.youtube.com/embed/6lvjPOZxeqE', 0),
(2, 'Her', 'img/Tienda/her.png', 'https://www.youtube.com/embed/UKMehPI1sUg', 0),
(3, 'Indiana Jones y la última cruzada', 'img/Tienda/indianajones.png', 'https://www.youtube.com/embed/5YbMpOOonJs', 0),
(4, 'Pack Star Wars', 'img/Tienda/peliStarWars.png', 'https://www.youtube.com/embed/SHDhb_iyhA0', 0),
(5, 'Matrix', 'img/Tienda/Matrix-155050517-large.jpg', 'https://www.youtube.com/embed/vN_Hx_It3r0', 0),
(6, 'Trilogia El señor de los anillos', 'img/Tienda/el-senor-de-los-anillos.png', 'https://www.youtube.com/embed/GuW21RLMndc', 0),
(7, 'El hombre de Acero', 'img/Tienda/el-hombre-de-acero.png', 'https://www.youtube.com/embed/VzeDi7YR6gs', 0),
(8, 'Los vengadores', 'img/Tienda/avengers.png', 'https://www.youtube.com/embed/HQIiYqOVTWo', 0),
(9, 'Pesadilla en Elm Street', 'img/Tienda/Pesadilla_en_Elm_Street_El_origen.jpg', 'https://www.youtube.com/embed/v1iXrlFV4Ls', 0),
(10, '8 apellidos vascos', 'img/Tienda/ocho-apellidos-blu-ray.png', 'https://www.youtube.com/embed/426QdCdtZlk', 0),
(11, 'El truco final', 'img/Tienda/TrucoFinal.png', 'https://www.youtube.com/embed/ryPvkaegEaI', 0),
(12, 'Como Dios', 'img/Tienda/como-dios-blu-ray-l_cover.png', 'https://www.youtube.com/embed/icuTE1A2e2E', 0);


INSERT INTO `tienegenerotienda` (`IDTiendaPeli`, `Genero`) VALUES
(1, 1),
(3, 1),
(7, 1),
(8, 1),
(4, 2),
(5, 2),
(6, 2),
(10, 3),
(12, 3),
(11, 8),
(2, 10),
(9, 12);


INSERT INTO `tieneoferta` (`IDTiendaPeli`, `Descuento`) VALUES
(1, 0),
(2, 3),
(3, 2),
(4, 0),
(5, 0),
(6, 0),
(7, 4),
(8, 1),
(9, 0),
(10, 2),
(11, 0),
(12, 0);


INSERT INTO `tipodisco` (`IDTiendaPeli`, `Stock`, `Precio`) VALUES
(1, 5, '20.00'),
(2, 3, '20.00'),
(3, 5, '18.00'),
(4, 1, '21.00'),
(5, 10, '12.00'),
(6, 5, '25.00'),
(7, 4, '24.00'),
(8, 4, '20.00'),
(9, 3, '19.00'),
(10, 4, '17.00'),
(11, 5, '15.00'),
(12, 5, '17.00');



INSERT INTO `amigo` (`nick1`, `nick2`) VALUES
('Pablo', 'jairo'),
('rafa', 'jairo'),
('rafa', 'Pablo');


INSERT INTO `vota` (`Nick`, `IdPeli`, `Nota`) VALUES
('jairo', 11, 3),
('Jairo', 12, 4),
('Jairo', 17, 2),
('Pablo', 15, 3),
('rafa', 17, 5);

