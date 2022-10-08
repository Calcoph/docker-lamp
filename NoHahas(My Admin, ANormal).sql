-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2022 a las 23:30:38
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `librerias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookmarks`
--

CREATE TABLE `bookmarks` (
  `Book ID` varchar(50) NOT NULL DEFAULT '',
  `User ID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bookmarks`
--

INSERT INTO `bookmarks` (`Book ID`, `User ID`) VALUES
('Beware of Chicken', 'Aitor'),
('Beware of Chicken', 'Mikel'),
('Worm', 'Mikel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo`
--

CREATE TABLE `capitulo` (
  `Chapter_ID` varchar(50) NOT NULL,
  `Book ID` varchar(50) NOT NULL,
  `Chapter Num` int(10) DEFAULT NULL,
  `Texto` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `capitulo`
--

INSERT INTO `capitulo` (`Chapter_ID`, `Book ID`, `Chapter Num`, `Texto`) VALUES
('Full Steam Ahead', 'Beware of Chicken', 2, '\r\n\r\nThe Crimson Phoenix Empire. A name that resounds across the known world.\r\n\r\nA land of power and glory. Of industry, of art, of culture. A superpower that dominates a continent under the watchful eye of the Son of Heaven, His Imperial Majesty, and his Bureaucracy.\r\n\r\nIt’s grand cities can house millions. It’s length and breadth could not be seen in a mortal lifetime, encompassing floating islands, hidden realms, and untamed wilderness that boggles the mind. Poison Bogs. Befuddling forests, and mountains that scrape the very edge of the sky, too tall for any to climb.\r\n\r\nIt is a land of cultivators, striving every day to defy the heavens. A hundred thousand battles, great and small, rage across the continent. Martial Tournaments. Bandit attacks. Rampaging Spirit Beasts. Pub brawls. Wars in all but name between the Sects. The great battle at the Five Immortal Phoenix Gates, against the latest round of Demonic invaders.\r\n\r\nIt is a never ending climb to the top. To win glory, fame, merit, accolades. To rise above your birth, and defy the heavens. To train and fight an struggle and strive.\r\n\r\nA thousand tales may be told of martyrs, of the most vile of villains and the greatest of heroes. Battles that shake the heavens, and upend the status quo.\r\n\r\nOne only needs to pick up their sword, steel their resolve, and fight!\r\n\r\nBut this…. This is not one of those stories.\r\n\r\nUpon the northern reaches of the sprawling Crimson Phoenix Continent lay the Azure Hills. A mostly landlocked province, with only a tiny bit of ocean available at it’s southwestern edge. Full of giant rolling hills and grassy knolls. It is so named for the purity of it’s clear sky, and the prevalence of said hills. As befitting a northern province, the seasons are temperate, and a great amount of snow falls each winter.\r\n\r\nAs all provinces of the Empire, the Azure Hills are enormous, nearly a country in their own right. But they bear a nearly unforgivable sin.\r\n\r\nThe Azure Hills are weak.\r\n\r\nIn every story, they are absent. No name from their pitiful lands has ever been able to reach the heavens. It\'s only outstanding quality is its weakness. The only reason why it is even remembered is it’s worthlessness.\r\n\r\nIt is here that a man decided that his future lay. In a backwater nowhere no man of ambition would subject himself to.\r\n\r\nHe had no desire to have his name resound through the heavens. He had no desire to obtain limitless, transcendent power. He cared little for merit or glory.\r\n\r\nHe just wanted to live a peaceful life. To have a little patch of heaven to call his own.\r\n\r\n////////\r\n\r\nI woke up content. Well, not just woke up content. Contentedness had just been my state of being ever since the wedding.\r\n\r\nThere was a pleasantly warm body pressed against my chest, and I was curled around it. My arm wrapped around her chest and my palm was held over her heart by her own hands. I could feel the steady slow beats of her heart, pulsing gently against my hand.\r\n\r\nMy wife. Still something I was getting used to. I was married. It was... A bit weird, I will confess, but it was mostly lost in a haze of good feelings.\r\n\r\nMy wife was beautiful. Idiots called her eyes sharp, her tongue a dagger and her freckles blemishes.\r\n\r\nHer eyes were beautiful amethysts, her freckles made her cute, and her tongue…\r\n\r\nHer tongue was very nice too. Uh, yeah. Thats all I’m going to say about that.\r\n\r\nTo my sensibilities, we had moved extremely quickly. Like Las Vegas, shotgun wedding fast. But to the people here… well, it wasn’t so abnormal.\r\n\r\nBut it was good. Very good. Especially the sleeping in the same bed part. It may just be the honeymoon period talking, but we were getting rather less sleep than we probably should.\r\n\r\nI pressed my nose into green-tinted hair, and took a breath. She smelled like herbs. It was a very nice smell.\r\n\r\nMeiling stirred in my grip, and her hands tightened briefly against my hand on her chest, trying to pull me closer. She let out a little sigh of contentment, and a sleepy murmur as she let go.\r\n\r\n“Good Morning.” I murmured into her hair.\r\n\r\n“‘Morn--morning.” She yawned, raising her arms above her head and stretching, wiggling against my body in interesting ways. She rolled over in my arms. Her wonderful violet eyes were still lidded with tiredness.\r\n\r\nShe pressed a kiss to my lips, and we just cuddled for a while. Her body was warm and smooth, and her heartbeat nearly lulled me back to sleep. Our breathing synchronised, as we lay together.\r\n\r\nEverything felt right.\r\n\r\nI pondered what I was going to say.\r\n\r\n“I like swimming, and the smell of rain, but I really hate getting rained on.” I eventually said, deciding on my “fact of the morning.”\r\n\r\nWe were married, but didn’t actually know too much about each other. So.. I had decided, on the second day, to tell her something random that I thought of about myself every morning. It was mostly knowledge that didn’t really matter, but… well, she seemed to enjoy it. Or at least she humored me enough to tell me stuff back.\r\n\r\nMeiling hummed, amused. “So that\'s why you were so grumpy yesterday. I thought it was because Gou Ren messed something up.”\r\n\r\nI shrugged. What can you do. I liked the outdoors, but getting soaking wet through rain always put me in a bit of a bad mood. I chose a great profession in farming for that, didn’t I? I needed to go outside in the rain all the time.\r\n\r\nMeimei smiled up at me. “Well, something in common. I really hate getting rained on too.”\r\n\r\nThere was a loud call from outside, as Big D sounded the morning bell.\r\n\r\nI sighed, wishing I could just spend the entire day in bed. Instead, I kissed Meiling on the forehead, and we both got up to get dressed. But at least there was one ritual that we had decided on that let us have a few more moments together.\r\n\r\nI ran a comb through my wife\'s hair. It was simple. But the feeling of silky smooth locks through my fingers calmed me down, and let me think a bit better.\r\n\r\nWe prepared the rest of the morning in silence. We both took breaths at the door, remembering the long, long day ahead of us.\r\n\r\n“This is the hardest part. Once summer hits, we’ll have less to do.” I muttered to myself.\r\n\r\nI reached out for Meimei’s hand, entwining our fingers.\r\n\r\n“Alright. Let\'s do this.” I declared.\r\n\r\nWe marched downstairs. I started the fire, while Meimei went and got the eggs. Eggs and rice, an imaginative breakfast. I was craving an egg and cheese sandwich, but I restrained myself. I may have to wait a while for that, but It would be with my eggs, my bread, and my cheese. With my hash browns too.\r\n\r\nThink of it, Jin. let the desire fuel your movements!\r\n\r\nBy the time breakfast was ready, everyone else had sat down, and was ready to start the day. Big D bowed slightly, as we came in with the food. His colours were as vibrant as ever, and his fox-fur vest as pristine as when I first gave it to him. Beside him sat Rizzo, the little rat still sleepy, and seeming to doze. Washy, the dull brown carp, was in his trough, ramrod straight and slapping his fins happily in anticipation for food. Chunky was next, the big boy curled next to Peppa. His scars had faded to white lines, but they still lent the big suck a dangerous air.\r\n\r\nTigger was the last of the animals, The tiger-striped cat sitting grumply at the table, and glaring at everyone and everything. She had been in a spectacularly bad mood ever since she was refused entry into my room at night.\r\n\r\nThough Io suppose I should consider her feelings too. She was basically still a kitten, and she had just gotten kicked out of her parent’s bed.\r\n\r\nI nearly sighed at the thought. Worrying about how animals are taking your marriage. How surreal my life had become.\r\n\r\nThe other two guests were human. The first was our friend from Hong Yaowu, and acting farmhand, Gou Ren.\r\n\r\nGou Ren had a bit of an unfortunate face. His nose was a bit too wide, and his sideburns grew in just the right way to make him look a bit like a monkey.\r\n\r\nHe looked well rested, and was scratching Chunky behind his ears.\r\n\r\nOur other guest was sitting with great dignity at the table. She bowed in respect when she was served. Her silky brown hair was immaculate, and her white robe pristine.\r\n\r\nPeppa raised her head blearily as the food was set in front of her, and with a single, dainty bite, the eggs and rice were gone, the bowl cleaned.\r\n\r\nWe ate largely in silence, as I considered my options.\r\n\r\nEach and every day was a learning experience. My first learning experience was delegation. It\'s amazing how much you get stuck in your ways over the course of just a year. But now, I had people to help me. I had to talk to people. The first day of work had been hilariously awkward, as I had just kind of gone off and started to do my own thing, while everybody else had been waiting for direction.\r\n\r\n“Gou Ren, you’re on the rice patties today.” I decided. “Shore up the walls like I taught you, and then we’ll move on to sorting the seed.”\r\n\r\nHe groaned. “Qi reinforcement is the bane of my existence.” he declared seriously. “Do I really have to do the whole thing?”\r\n\r\n“Yup. Gotta make sure it won’t collapse, else you’re going to lose the entire harvest.” Gou Ren sighed at my reply but nodded.\r\n\r\n“Xiulan.” The other woman perked up immediately at the mention of her name, leaning forward eagerly. “The western field, please.” She nodded her head magnanimously, but she seemed a bit disappointed.\r\n\r\n“Meimei, what you planned on yesterday.” I said, though I didn’t really need to. She knew what she was doing.\r\n\r\n“I’m going to be out with Babe. Work him for a little.” Honestly I felt a bit sorry for the ox. I had named him after Paul Bunyan’s companion, but he barely had anything to do. Ironically, the big, strong ox was one of the weakest things here. Maybe he was stronger than Rizzo, but I wouldn’t bet on it.\r\n\r\nWe finished our meal, and got started for the day.\r\n\r\n//////////\r\n\r\nIt was slowly getting hotter as it beat down on the land. The snows had long since melted, but the river was still ice cold. The ground had hardened up a bit, firming in the sun from a quagmire to something that was workable.\r\n\r\n“Ooh, this is nice.” I mused aloud as we used the new plow. The edge of the formerly demonic blade bit deep, and sliced through the soil like a hot knife through butter. It took my Qi easily, a lot more easily than my last plow. Babe pulled, and we went fast enough. I patted the ox on his rump. He was a good boy. Obedient, calm, and easy to control, but still an actual animal instead of a Spirit Beast.\r\n\r\nHe needed something to do other than sit around and get fat, so we went to work together. We worked together, and he did his job well. Though it was mostly the plow.\r\n\r\nIt was a really nice plow. If a bit unadorned. Rough and simple looking though.\r\n\r\nMy mind wandered as we worked.\r\n\r\nI was on field two. This one was going to be the root vegetable field. Radish, turnup, and most importantly, potatoes. There would be hashbrowns in my future.\r\n\r\nBehind me, a gaggle of chickens followed, pecking eagerly at the bugs unearthed by my efforts. They fluttered and squawked, making little clucking noises as they ate.\r\n\r\nAnd, there was a certain someone on my shoulder. Big D was in his usual place, gazing imperiously from his perch. He watched over the rest of the chickens, to make sure they didn’t go too far, and a single, sharp cluck would bring them back into line.\r\n\r\nOccasionally, he too would hop down and pluck a particularly fat looking bug out of the air, before returning to his position. I scratched his wattles affectionately when he did.\r\n\r\nBack and forth across the field we went, pulling the plow. Each step was as even, and each furrow was as an exact distance I could make it.\r\n\r\nI idly looked at the plow again, and my lips quirked into a smile.\r\n\r\nI patted it twice. “I dub thee Sunny.” I declared. I could almost imagine Sun Ken, the blade’s previous owner, spinning in his grave.\r\n\r\nI could already see the sun carvings on it, along with a nice coat of yellow paint.A happy, cheerful plow.\r\n\r\nIn what felt like no time at all, I was finished. The sun was high in the sky, and I was terribly thirsty. I took a swig from my bamboo drinking container, and wandered over to the river with Babe to splash some cold water on my face, to wash away some of the sweat.\r\n\r\nIt was brisk, but invigorating.\r\n\r\nI sighed in contentment, and leaned back. I felt good. A wonderful start, to a wonderful spring.\r\n\r\nBig D agreed with me, ripping loose a call from his place on Babe’s back, happy to be planting again.\r\n\r\n“You tell ‘em, Big D.” I said with a smile.\r\n'),
('Gestation 1', 'Worm', 1, 'Class ended in five minutes and all I could think was, an hour is too long for lunch.\r\n\r\nSince the start of the semester, I had been looking forward to the part of Mr. Gladly’s World Issues class where we’d start discussing capes.  Now that it had finally arrived, I couldn’t focus.  I fidgeted, my pen moving from hand to hand, tapping, or absently drawing some figure in the corner of the page to join the other doodles.  My eyes were restless too, darting from the clock above the door to Mr. Gladly and back to the clock.  I wasn’t picking up enough of his lesson to follow along.  Twenty minutes to twelve; five minutes left before class ended.\r\n\r\nHe was animated, clearly excited about what he was talking about, and for once, the class was listening.  He was the sort of teacher who tried to be friends with his students, the sort who went by “Mr. G” instead of Mr. Gladly.  He liked to end class a little earlier than usual and chat with the popular kids, gave lots of group work so others could hang out with their friends in class, and had ‘fun’ assignments like mock trials.\r\n\r\nHe struck me as one of the ‘popular’ kids who had become a teacher.  He probably thought he was everyone’s favorite.  I wondered how he’d react if he heard my opinion on the subject.  Would it shatter his self image or would he shrug it off as an anomaly from the gloomy girl that never spoke up in class?\r\n\r\nI glanced over my shoulder.  Madison Clements sat two rows to my left and two seats back.  She saw me looking and smirked, her eyes narrowing, and I lowered my eyes to my notebook.  I tried to ignore the ugly, sour feeling that stewed in my stomach.  I glanced up at the clock.  Eleven-forty-three.\r\n\r\n“Let me wrap up here,” Mr. Gladly said, “Sorry, guys, but there is homework for the weekend.  Think about capes and how they’ve impacted the world around you.  Make a list if you want, but it’s not mandatory.  On Monday we’ll break up into groups of four and see what group has the best list.  I’ll buy the winning group treats from the vending machine.”\r\n\r\nThere were a series of cheers, followed by the classroom devolving into noisy chaos.  The room was filled with sounds of binders snapping shut, textbooks and notebooks being slammed closed, chairs screeching on cheap tile and the dull roar of emerging conversation.  A bunch of the more social members of the class gathered around Mr. Gladly to chat.\r\n\r\nMe?  I just put my books away and kept quiet.  I’d written down almost nothing in the way of notes; there were collections of doodles spreading across the page and numbers in the margins where I’d counted down the minutes to lunch as if I was keeping track of the timer on a bomb.\r\n\r\nMadison was talking with her friends.  She was popular, but not gorgeous in the way the stereotypical popular girls on TV were.  She was ‘adorable’, instead.  Petite.  She played up the image with sky blue pins in her shoulder length brown hair and a cutesy attitude. Madison wore a strapless top and denim skirt, which seemed absolutely moronic to me given the fact that it was still early enough in the spring that we could see our breath in the mornings.\r\n\r\nI wasn’t exactly in a position to criticize her.  Boys liked her and she had friends, while the same was hardly true for me.  The only feminine feature I had going for me was my dark curly hair, which I’d grown long.  The clothes I wore didn’t show skin, and I didn’t deck myself out in bright colors like a bird showing off its plumage.\r\n\r\nGuys liked her, I think, because she was appealing without being intimidating.\r\n\r\nIf they only knew.\r\n\r\nThe bell rang with a lilting ding-dong, and I was the first one out the door.  I didn’t run, but I moved at a decent clip as I headed up the stairwell to the third floor and made my way to the girl’s washroom.\r\n\r\nThere were a half dozen girls there already, which meant I had to wait for a stall to open up.  I nervously watched the door of the bathroom, feeling my heart drop every time someone entered the room.\r\n\r\nAs soon as there was a free stall, I let myself in and locked the door.   I leaned against the wall and exhaled slowly.  It wasn’t quite a sigh of relief.  Relief implied you felt better.  I wouldn’t feel better until I got home.  No, I just felt less uneasy.\r\n\r\nIt took maybe five minutes before the noise of others in the washroom stopped.  A peek below the partitions showed that there was nobody else in the other stalls.  I sat on the lid of the toilet and got my brown bag lunch to begin eating.\r\n\r\nLunch on the toilet was routine now.  Every school day, I would finish off my brown bag lunch, then I’d do homework or read a book until lunch hour was over.  The only book in my bag that I hadn’t already read was called ‘Triumvirate’, a biography of the leading three members of the Protectorate.  I was thinking I would spend as long as I could on Mr. Gladly’s assignment before reading, because I wasn’t enjoying the book.  Biographies weren’t my thing, and they were especially not my thing when I was suspicious it was all made up.\r\n\r\nWhatever my plan, I didn’t even have a chance to finish my pita wrap.  The door of the bathroom banged open.  I froze.  I didn’t want to rustle the bag and clue anyone into what I was doing, so I kept still and listened.\r\n\r\nI couldn’t make out the voices.  The noise of the conversation was obscured by giggling and the sound of water from the sinks.  There was a knock on the door, making me jump.  I ignored it, but the person on the other side just repeated the knock.\r\n\r\n“Occupied,” I called out, hesitantly.\r\n\r\n“Oh my god, it’s Taylor!” one of the girls on the outside exclaimed with glee, then in response to something another girl whispered, I barely heard her add, “Yeah, do it!”\r\n\r\nI stood up abruptly, letting the brown bag with the last mouthful of my lunch fall to the tiled floor.  Rushing for the door, I popped the lock open and pushed.  The door didn’t budge.\r\n\r\nThere were noises from the stalls on either side of me, then a sound above me.  I looked up to see what it was, only to get splashed in the face.  My eyes started burning, and I was momentarily blinded by the stinging fluid in my eyes and my blurring of my glasses.  I could taste it as it ran down to my nose and mouth.  Cranberry juice.\r\n\r\nThey didn’t stop there.  I managed to pull my glasses off just in time to see Madison and Sophia leaning over the top of the stall, each of them with plastic bottles at the ready.  I bent over with my hands shielding my head just before they emptied the contents over me.\r\n\r\nIt ran down the back of my neck, soaked my clothes, fizzed as it ran through my hair.  I pushed against the door again, but the girl on the other side was braced against it with her body.\r\n\r\nIf the girls pouring juice and soda on me were Madison and Sophia, that meant the girl on the other side of the door was Emma, leader of the trio.  Feeling a flare of anger at the realization, I shoved on the door, the full weight of my body slamming against it.  I didn’t accomplish anything, and my shoes lost traction on the juice-slick floor.  I fell to my knees in the puddling juice.\r\n\r\nEmpty plastic bottles with labels for grape and cranberry juice fell to the ground around me.  A bottle of orange soda bounced off my shoulder to splash into the puddle before rolling under the partition and into the next stall.  The smell of the fruity drinks and sodas was sickly sweet.\r\n\r\nThe door swung open, and I glared up at the three girls.  Madison, Sophia and Emma.  Where Madison was cute, a late bloomer, Sophia and Emma were the types of girls that fit the ‘prom queen’ image.  Sophia was dark skinned, with a slender, athletic build she’d developed as a runner on the school track team.  Red-headed Emma, by contrast, had all the curves the guys wanted.  She was good looking enough to get occasional jobs as a amateur model for the catalogs that the local department stores and malls put out.  The three of them were laughing like it was the funniest thing in the world, but the sounds of their amusement barely registered with me.  My attention was on the faint roar of blood pumping in my ears and an urgent, ominous crackling ‘sound’ that wouldn’t get any quieter or less persistent if I covered my ears with my hands.  I could feel dribbles running down my arms and back, still chilled from the refrigerated vending machines.\r\n\r\nI didn’t trust myself to say something that wouldn’t give them fodder to taunt me with, so I kept silent.\r\n\r\nCarefully, I climbed to my feet and turned my back on them to get my backpack off the top of the toilet.  Seeing it gave me pause.  It had been a khaki green, before, but now dark purple blotches covered it, most of the contents of a bottle of grape juice.  Pulling the straps around my shoulders, I turned around.  The girls weren’t there.  I heard the bathroom door bang shut, cutting off the sounds of their glee, leaving me alone in the bathroom, drenched.\r\n\r\nI approached the sink and stared at myself in the scratched, stained mirror that was bolted above it.  I had inherited a thin lipped, wide, expressive mouth from my mother, but my large eyes and my gawky figure made me look a lot more like my dad.  My dark hair was soaked enough that it clung to my scalp, neck and shoulders.  I was wearing a brown hooded sweatshirt over a green t-shirt, but colored blotches of purple, red and orange streaked both.  My glasses were beaded with the multicolored droplets of juice and soda.  A drip ran down my nose and fell from the tip to land in the sink.\r\n\r\nUsing a paper towel from the dispenser, I wiped my glasses off and put them on again.  The residual streaks made it just as hard to see, if not worse than it had been.\r\n\r\nDeep breaths, Taylor, I told myself.\r\n\r\nI pulled the glasses off to clean them again with a wet towel, and found the streaks were still there.\r\n\r\nAn inarticulate scream of fury and frustration escaped my lips, and I kicked the plastic bucket that sat just beneath the sink, sending it and the toilet brush inside flying into the wall.  When that wasn’t enough, I pulled off my backpack and used a two-handed grip to hurl it.  I wasn’t using my locker anymore: certain individuals had vandalized or broken into it on four different occasions.  My bag was heavy, loaded down with everything I’d anticipated needing for the day’s classes.  It crunched audibly on impact with the wall.\r\n\r\n“What the fuck!?” I screamed to nobody in particular, my voice echoing in the bathroom.  There were tears in the corners of my eyes.\r\n\r\n“The hell am I supposed to do!?”  I wanted to hit something, break something.  To retaliate against the unfairness of the world.  I almost struck the mirror, but I held back.  It was such a small thing that it felt like it would make me feel more insignificant instead of venting my frustration.\r\n\r\nI’d been enduring this from the very first day of high school, a year and a half ago.  The bathroom had been the closest thing I could find to refuge.  It had been lonely and undignified, but it had been a place I could retreat to, a place where I was off their radar.  Now I didn’t even have that.\r\n\r\nI didn’t even know what I was supposed to do for my afternoon classes.  Our midterm project for art was due, and I couldn’t go to class like this.  Sophia would be there, and I could just imagine her smug smile of satisfaction as I showed up looking like I’d botched an attempt to tie-dye everything I owned.\r\n\r\nBesides, I’d just thrown my bag against the wall and I doubted my project was still in one piece.\r\n\r\nThe buzzing at the edge of my consciousness was getting worse.  My hands shook as I bent over and gripped the edge of the sink, let out a long, slow breath, and let my defenses drop.  For three months, I’d held back.  Right now?  I didn’t care anymore.\r\n\r\nI shut my eyes and felt the buzzing crystallize into concrete information.  As numerous as stars in the night sky, tiny knots of intricate data filled the area around me.  I could focus on each one in turn, pick out details.  The clusters of data had been reflexively drifting towards me since I was first splashed in the face.  They responded to my subconscious thoughts and emotions, as much of a reflection of my frustration, my anger, my hatred for those three girls as my pounding heart and trembling hands were.  I could make them stop or direct them to move almost without thinking about it, the same way I could raise an arm or twitch a finger.\r\n\r\nI opened my eyes.  I could feel adrenaline thrumming through my body, blood coursing in my veins.  I shivered in response to the chilled soft drinks and juices the trio had poured over me, with anticipation and with just a little fear.  On every surface of the bathroom were bugs; Flies, ants, spiders, centipedes, millipedes, earwigs, beetles, wasps and bees.  With every passing second, more streamed in through the open window and the various openings in the bathroom, moving with surprising speed.  Some crawled in through a gap where the sink drain entered the wall while others emerged from the triangular hole in the ceiling where a section of foam tile had broken off, or from the opened window with peeling paint and cigarette butts squished out in the recesses.  They gathered around me and spread out over every available surface; primitive bundles of signals and responses, waiting for further instruction.\r\n\r\nMy practice sessions, conducted away from prying eyes, told me I could direct a single insect to move an antennae, or command the gathered horde to move in formation.  With one thought, I could single out a particular group, maturity or species from this jumble and direct them as I wished.  An army of soldiers under my complete control.\r\n\r\nIt would be so easy, so easy to just go Carrie on the school.  To give the trio their just desserts and make them regret what they had put me through: the vicious e-mails, the trash they’d upended over my desk, the flute –my mother’s flute– they’d stolen from my locker.  It wasn’t just them either.  Other girls and a small handful of boys had joined in, ‘accidentally’ skipping over me when passing out assignment handouts, adding their own voices to the taunts and the flood of nasty emails, to get the favor and attention of three of the prettier and more popular girls in our grade.\r\n\r\nI was all too aware that I’d get caught and arrested if I attacked my fellow students.  There were three teams of superheroes and any number of solo heroes in the city.  I didn’t really care.  The thought of my father seeing the aftermath on the news, his disappointment in me, his shame?  That was more daunting, but it still didn’t outweigh the anger and frustration.\r\n\r\nExcept I was better than that.\r\n\r\nWith a sigh, I sent an instruction to the gathered swarm.   Disperse.  The word wasn’t as important  as the idea behind it.  They began to exit the room, disappearing into the cracks in the tile and through the open window.  I walked over to the door and stood with my back to it so nobody could stumble onto the scene before the bugs were all gone.\r\n\r\nHowever much I wanted to, I couldn’t really follow through.  Even as I trembled with humiliation, I managed to convince myself to pick up my backpack and head down the hall.  I made my way out of the school, ignoring the stares and giggles from everyone I walked past, and caught the first bus that headed in the general direction of home.  The chill of early spring compounded the discomfort of my soaked hair and clothes, making me shiver.\r\n\r\nI was going to be a superhero.  That was the goal I used to calm myself down at moments like these.  It was what I used to make myself get out of bed on a school day.  It was a crazy dream that made things tolerable.  It was something to look forward to, something to work towards.  It made it possible to keep from dwelling on the fact that Emma Barnes, leader of the trio, had once been my best friend.'),
('Gestation 2', 'Worm', 2, 'My thoughts were on Emma on the bus ride home.  For an outside observer, I think it’s easy to trivialize the importance of a ‘best friend’, but when you’re a kid, there’s nobody more important.  Emma had been my ‘BFF’ from grade one all the way through middle school.  It hadn’t been enough for us to spend our time together at school, so we had alternated staying at each others houses every weekend.  I remember my mother saying that we were so close we were practically sisters.'),
('Gestation 3', 'Worm', 3, 'My training schedule consisted of running every morning and every other afternoon.  In the process, I had picked up a pretty good knowledge of the east side of the city.  Growing up in Brockton Bay, my parents had told me stuff like “stick to the Boardwalk”.  Even on my runs, I had scrupulously stayed on the Boardwalk and avoided the bad part of town.  Now it was Sunday night and I was in costume and breaking the rules.'),
('Gestation 4', 'Worm', 4, 'I felt a chill.  A part of me really wished that I had thought to get my hands on a disposable cell phone.  I didn’t have a utility belt, but the spade shaped section of armor that hung over my spine hid a set of EpiPens, a pen and notepad, a tube of pepper spray meant to hang off a key chain and a zippered pouch of chalk dust.  I could have fit a cell phone back there.  With a cell phone, I could have alerted the real heroes about the fact that Lung was planning to take a score of his flunkies to go and shoot kids.'),
('Gestation 5', 'Worm', 5, 'You don’t properly appreciate what superhuman strength means until you see someone leap from the sidewalk to the second floor of a building on the far side of the street.  He didn’t make it all the way to the roof, but he came to a point maybe three quarters of the way up.  I wasn’t sure just how Lung kept from falling, but I could only guess that he just buried his fingertips into the building’s exterior.'),
('Gestation 6', 'Worm', 6, 'I heard the cape arrive on his souped up motorcycle.  I didn’t want to be seen fleeing the scene of a fight, and risk being labeled one of the bad guys by yet another person, but I wasn’t about to get closer to the street either, in case Lung was feeling better.  Since there was nowhere to go, I just stayed put.  Just resting felt good.'),
('Gestation Interlude', 'Worm', 7, '“We don’t know how long he had been there.  Suspended in the air above the Atlantic Ocean.  On May twentieth, 1982, an ocean liner was crossing from Plymouth to Boston when a passenger spotted him.  He was naked, his arms to his sides, his long hair blowing in the wind as he stood in the sky, nearly a hundred feet above the gently cresting waves.  His skin and hair can only be described as a burnished gold.  With neither body hair nor clothes to cover him, it is said, he seemed almost artificial.'),
('He Bravely Turned His Tail and Fled', 'Beware of Chicken', 1, 'Beware of Chicken\r\n\r\nIn which a transmigrator decides the only winning move is to get the hell out of dodge.\r\n\r\n////////\r\n\r\nLu Ri stared at the disciple. The boy had his arm in a sling, a black eye, and several other wounds marring his body. A quite pitiful sight, all told.\r\n\r\n“You wish to leave the sect?” He asked, repeating the disciples request..\r\n\r\n“Yes, Senior Brother,” The disciple said. “This Jin Rou’s abilities are lacking, and I was defeated by others two years my younger. I would leave before I bring greater shame upon this Cloudy Sword Sect.\"\r\n\r\nLu Ri nearly sighed. In all honesty, him being crushed by one of the inner disciples looking for someone to “practise” with was a forgone conclusion, even with the age difference. The elder disciple considered the brown haired boy. Indeed, Jin Rou was not powerful, but he was diligent, and always willing to tend to the less desirable tasks around the sect. Losing him for his attention to detail in caring for the compound and lowly spirit herbs would be a minor blow… but it was hardly anything that the sect would notice losing. The boy had no real training, or techniques of the sect yet either.\r\n\r\nAnd if this was enough to crush his spirit, and ask to leave… Then he was not meant to be a cultivator in the first place. This was no place for the weak of heart.\r\n\r\nAt least he was polite enough to formally go through with his leaving, instead of just disappearing. He was the first in over three hundred years to use such courtesies, and had even provided the sum that was his recompense to the sect for taking him in, as outlined in the proper documents. Lu Ri considered attempting to dissuade him from leaving… but he felt no tumult in the boy’s paltry Qi. His conviction was set.\r\n\r\n“What is your intent after leaving this place, Disciple?” he asked out of idle curiosity.\r\n\r\n“I shall become a farmer, Senior Brother,” The boy replied, “I had some luck in growing the lowly spiritual herbs, so such a thing should be within my minor talents.”\r\n\r\nLu Ri once more nearly spoke against it, at hearing this madness. A mere farmer, from a boy who, though barely, passed the first of their sect’s initiation? The devastating defeat must have completely demoralised him. Unfortunate.\r\n\r\nThis time he did sigh.\r\n\r\n“I see. I shall mark down your leaving. You are no longer a disciple of our sect, Jin Rou.”\r\n\r\nJin Rou bowed his head, and clasped his fist in front of him. “This Jin Rou thanks you for your time and consideration. I shall darken the compound’s halls no longer.”\r\n\r\nLu Ri stood, and inclined his head. “Then go into the world, Jin Rou.... and here.”\r\n\r\nHe held the pouch containing the severance money back out to him. “I shall mark it down as paid in full. Diligence and proper courtesy deserve some reward, and the sect does not need such a paltry sum.” It was probably all the money the boy had, anyway. He did have some kindness to him, and Jin Rou would need the luck of heaven in the future.\r\n\r\nJin Rou looked shocked, but again bowed his head in supplication.\r\n\r\n“May Heaven be kind to you, Lu Ri.”\r\n\r\nAnd then Jin Rou was gone from the sect.\r\n\r\nHis leaving went unnoticed.\r\n\r\n///////\r\n\r\n \r\n\r\nI came to in the middle of dear old Jinny-boy getting his ass beat by a stereotypical “young master” type.\r\n\r\nLet me tell you, that was horse shit. Jin was kind of an idiot for not getting out of the way in time when the little shit wanted to fuck somebody up, but at least there was no meridian destroying because “the commoner was so beneath him”.\r\n\r\nA few of the other disciples were kind enough to drag my twitching body back to my little room... and then ransacked some of the herbs as \"payment\".\r\n\r\nDicks.\r\n\r\nIt only really hit me that I was in magical china land while I was moaning in pain. Apparently one of the bodyshots had hit poor Jin hard enough, and in just the right way to stop his heart and kill him.\r\n\r\nAnd before he even fell over, I got shoved in. At least I got his memories, and how to actually use the remainder of this current batch of herbs to deal with the worst of the damage. Which is some mashing and grinding, which is extremely painful with how many injuries I have got.\r\n\r\nJin himself was fairly respectable, I suppose. He was an orphan, after his gramps disappeared, who managed to join a sect through hard work, kind of. His admittance was because one of the instructors flipped a coin when deciding his fate, because he just barely squeaked past. Said something about heaven favoring him or some shit.\r\n\r\nJin was full of wanting to become a powerful cultivator, a master among masters, and do whatever it is the dickbags who run this place do, which is presumably to be dicks, dickishly. I kinda... did not care about his motivations. My body now, buddy. Sorry, not sorry. Dear old Jin was essentially a servant right now anyway, and had to do every task that the other people offloaded onto him, while harboring vengeance and hate and angst.\r\n\r\nAnd let me tell you, I wanted none of that shit. I declare any revenge fantasies and ambitions null and void. I wanted none of the little fuckboy who wasted my ass. And most importantly, I wanted nothing to do with the politics of this world, because holy shit. Lots of line extinguishing, and murdering each other for face.\r\n\r\nYou know, standard xianxia stuff.\r\n\r\nSo I looked up the methods to leaving the sect when I was mobile the next day, grabbed one of Jin’s pouches of money, and went to the guy in charge of this kind of stuff.\r\n\r\nI wasn’t expecting to get the money pouch back, but I was fine with losing that one. Jin was actually fairly good at saving: He had been saving to purchase a few spiritual pills, after picking up so many extra chores.\r\n\r\nBut what was his is now mine. And I’m getting the fuck out of here, and far away from all the sword formations and Grand demonic dick punches or whatever the fuck these chuuni bastards spout.\r\n\r\nSo I started travelling to the Azure Hills. Which was regarded as the weakest, and therefore safest place on the continent.\r\n\r\nHopefully anyways. Cultivators usually cleared out of “weak” places pretty quick.\r\n\r\n////////\r\n\r\nI smiled down at my new plot of land. It was a few rolling hills, covered by a forest, and had a lovely little river winding through it. It was fantastically picturesque, as were most places in the Red Phoenix Continent.\r\n\r\nThe land was considered largely useless by the Magistrate of the town, as there were some minor monsters around, and it needed lots of clearing, but hopefully nothing I couldn’t handle.\r\n\r\nIt was also extremely cheap. I had got this place for a steal. Man, fuck property prices back home, this is where its at. I had considered the possibility I had been fucked over, and asked the locals about this place, but nope. No sleeping big bad dudes, as far as anyone new. Just out of the way and more trouble than it was worth.\r\n\r\nPeople rarely came down this way too, as far as it was from the town, and the surrounding villages. Nobody to bother me here. Just peace.\r\n\r\nI breathed in the fantastically clean and invigorating air, and shook my head. Enough lazing around. I reached into my wagon and grabbed my axe, causing my chickens to cluck irritatedly at me and the young rooster to crow at the sudden jostling.\r\n\r\nI gave him a little scratch under his developing wattles, and he calmed.\r\n\r\nWell, time to get to work. Operation “No Cultivator Bullshit\" is go!\r\n\r\n////////\r\n\r\nTheres a certain sort of zen you reach when you engage in heavy physical activity for long enough. My axe hewed through trees, My saw made planks, my hammer drove in nails, and my plane made things level, fueled by the supernatural strength of cultivator, even if I was an exceptionally weak one. It was calming and invigorating at the same time, and I must confess I heartily enjoyed the heavy physical labour and the strength of ten men. My breathing was a perfect rhythm, and my qi circulated around me. I felt so invigorated and refreshed!\r\n\r\nThat, and being able to tear a stump out of the ground with nothing but brute strength would never get old.\r\n\r\nMy first home was a simple, one room affair, built within the first three days. It wasn’t anything spectacular, but it would keep the elements off me, and the bugs at bay, with it is thatch roof and pounded dirt floor. It was right against my chicken coop, so I could hear if there were any predatory interlopers during the night, but the foxes and the wolves had yet to notice my intrusion, and the prey animals that I had.\r\n\r\nI was proud of what I had built.\r\n\r\nI woke with the call of my rooster, who I had named Big D. An incredibly childish name, I confess, but it amused me greatly. My young lad would follow me around during the day, hopping around, and often sitting on my shoulder, and proclaiming his dominance to the world, the cheeky shit.\r\n\r\n“Cock-a-doddle-doo!” He’d screech.\r\n\r\n“You tell ‘em Big D.” I’d reply.\r\n\r\nMy hoe bit the earth and never dulled, reinforced as it was by my qi, tearing into it with more speed than any ox could generate. My chickens eagerly followed behind me, pecking the bugs and plants I unearthed with my efforts, bucking and clucking all the way.\r\n\r\nYes, get good and fat my pretties, and you will be delectable in the future.\r\n\r\nAh, my mouth is watering just thinking about it.\r\n\r\nUp and down went the hoe, up and down went the hoe, until I noticed something. A strange root poked out, and had a faint sense of qi about it. Interested, I picked up the lumpy, and slightly nondescript root.\r\n\r\nIn xianxia novels, this is where the protagonist would immediately identify the plant, spouting that it was some rare so and so root of six elixirs or something, but quite frankly, I had no fucking clue what it was. I’d have to go to the town Archive at some point, but considering it was here, it probably wasn’t very rare or important.\r\n\r\nShrugging, I put it into my house, and got back to work. After this field, which was going to be my vegetable garden, I’d start on the rice paddy. It sucks that I have not been able to get any wheat yet, but whatcha gonna do?\r\n\r\n//////\r\n\r\nThat night, I had an absolutely delicious egg fried rice, with Big D sitting on my shoulder. Maybe it was a little morbid, to eat eggs right near your pet chicken, but he didn’t seem to mind. Eggs from my chickens, rice from my reserves, some sesame oil that I had splurged on when I bought my land… and some of the leftover Lowly Spiritual Herbs I had uh, liberated from the Cloudy whatever sect. They tasted pretty damn good. A little spicy, a little sweet, a little savoury-- I’d definitely have to grow more of them. They weren’t that hard to grow from Jin’s memories. I’d just have to baby them for a bit.\r\n\r\nSure, I could convert them into pills, but I was extremely suspect about all the pills these people choked back. I’m half convinced the reason every cultivator is so damn nuts is because of all drugs they did.\r\n\r\nI shook myself out of my introspection and tuned to the pleased clucking sounds coming from my “kitchen.” Big D was eagerly pecking at the little nubs of spirit herb I had cut off that looked a bit wilted.\r\n\r\nThey probably wouldn’t kill him. Never heard of something dying from eating these things before.\r\n\r\nEh, if he likes ‘em, he likes ‘em. Not going to deny the little man his food.\r\n\r\nSoon enough, I got into my bed, with Big D jumping up onto the perch I made him by the window.\r\n\r\nMan, If I was still in the sect, I would be doing shitty chores, or sitting in a corner cultivating for months on end, instead of actually making stuff.\r\n\r\nI went to sleep happy and content with my life choices.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario capitulo`
--

CREATE TABLE `comentario capitulo` (
  `Comentario ID` varchar(50) NOT NULL DEFAULT '',
  `User ID` varchar(50) NOT NULL DEFAULT '',
  `Chapter_ID` varchar(50) NOT NULL,
  `Book ID` varchar(50) NOT NULL,
  `Texto` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario capitulo`
--

INSERT INTO `comentario capitulo` (`Comentario ID`, `User ID`, `Chapter_ID`, `Book ID`, `Texto`) VALUES
('1', 'Mikel', 'Gestation 1', 'Worm', 'A grim start for an even grimer story'),
('2', 'Aitor', 'He Bravely Turned His Tail and Fled', 'Beware of Chicken', 'just read this last night on spacebattles. very good');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario libro`
--

CREATE TABLE `comentario libro` (
  `Comentario ID` varchar(50) NOT NULL DEFAULT '',
  `User ID` varchar(50) NOT NULL DEFAULT '',
  `Book ID` varchar(50) NOT NULL DEFAULT '',
  `Texto` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario libro`
--

INSERT INTO `comentario libro` (`Comentario ID`, `User ID`, `Book ID`, `Texto`) VALUES
('3', 'Mikel', 'Worm', 'I just Binged the whole story in one sitting, I do not know how I was even able to'),
('4', 'Aitor', 'Beware of Chicken', 'Never laughed so hard in my whole life, this is a piece of art');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `Book ID` varchar(50) NOT NULL DEFAULT '',
  `Nota` decimal(2,1) NOT NULL DEFAULT 0.0,
  `img` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`Book ID`, `Nota`, `img`) VALUES
('Beneath the Dragoneye Moons', '0.0', NULL),
('Beware of Chicken', '4.9', NULL),
('Cinnamon Bun', '0.0', NULL),
('Mother of Learning', '0.0', NULL),
('Worm', '5.0', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `Used ID` varchar(50) NOT NULL,
  `Book ID` varchar(50) NOT NULL,
  `Nota` decimal(2,1) NOT NULL DEFAULT 0.0,
  `ID Review` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`Used ID`, `Book ID`, `Nota`, `ID Review`) VALUES
('Aitor', 'Beware of Chicken', '5.0', 3),
('Mikel', 'Beware of Chicken', '4.8', 2),
('Mikel', 'Worm', '5.0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Used ID` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(50) NOT NULL DEFAULT '',
  `img` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tendra unas cuantas cosas dentro de si, como contraseña, nombreID, Lista de Libros';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Used ID`, `Password`, `img`) VALUES
('Admin', 'test', NULL),
('Aitor', 'VIVA CHILE', NULL),
('Aligator 250', '214134351131253412771315171846123 41424251421 caba', NULL),
('Mikel', 'legenda1234', NULL),
('简单的', 'Simple', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`Book ID`,`User ID`),
  ADD KEY `Book ID` (`Book ID`),
  ADD KEY `Used ID` (`User ID`);

--
-- Indices de la tabla `capitulo`
--
ALTER TABLE `capitulo`
  ADD PRIMARY KEY (`Chapter_ID`,`Book ID`),
  ADD KEY `Book ID` (`Book ID`);

--
-- Indices de la tabla `comentario capitulo`
--
ALTER TABLE `comentario capitulo`
  ADD PRIMARY KEY (`Comentario ID`,`User ID`,`Chapter_ID`,`Book ID`),
  ADD KEY `Chapter_ID` (`Chapter_ID`),
  ADD KEY `Book ID` (`Book ID`),
  ADD KEY `User ID` (`User ID`);

--
-- Indices de la tabla `comentario libro`
--
ALTER TABLE `comentario libro`
  ADD PRIMARY KEY (`Comentario ID`,`User ID`,`Book ID`),
  ADD KEY `User ID` (`User ID`),
  ADD KEY `Book ID` (`Book ID`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`Book ID`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Used ID`,`Book ID`,`ID Review`),
  ADD KEY `Book ID` (`Book ID`),
  ADD KEY `Used ID` (`Used ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Used ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `Book ID M` FOREIGN KEY (`Book ID`) REFERENCES `libro` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID M` FOREIGN KEY (`User ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `capitulo`
--
ALTER TABLE `capitulo`
  ADD CONSTRAINT `Book ID` FOREIGN KEY (`Book ID`) REFERENCES `libro` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario capitulo`
--
ALTER TABLE `comentario capitulo`
  ADD CONSTRAINT `Book ID C` FOREIGN KEY (`Book ID`) REFERENCES `capitulo` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Chapter ID C` FOREIGN KEY (`Chapter_ID`) REFERENCES `capitulo` (`Chapter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID C` FOREIGN KEY (`User ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario libro`
--
ALTER TABLE `comentario libro`
  ADD CONSTRAINT `Book ID L` FOREIGN KEY (`Book ID`) REFERENCES `capitulo` (`Chapter_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID L` FOREIGN KEY (`User ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `Book ID R` FOREIGN KEY (`Book ID`) REFERENCES `libro` (`Book ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID R` FOREIGN KEY (`Used ID`) REFERENCES `usuario` (`Used ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
