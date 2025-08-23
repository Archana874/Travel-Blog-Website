<?php
include("db.php");

// Check if ID is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer

    // Fetch post from database
    $result = $conn->query("SELECT * FROM posts WHERE id=$id");

    if ($result && $post = $result->fetch_assoc()) {
        echo '<h1>' . htmlspecialchars($post['title']) . '</h1>' . '<style>h1 { color: #333; text-align: center; }</style>';

        // Display image
        $imagePath = "uploads/" . $post['image'];
        if (!empty($post['image']) && file_exists($imagePath)) {
            echo '<img src="' . $imagePath . '" width="500" height="300" alt="Post Image" style="border-radius: 8px; margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto;">';
        } else {
            echo '<p>No image available</p>';
        }

        // Display content
        echo '<p>';
        if ($id == 6) {
            echo "The Chamundeshwari Temple is a Hindu temple located on the top of Chamundi Hills about 13 km from the palace city of Mysuru in the state of Karnataka in India.[1] The temple was named after Chamundeshwari or, the fierce form of Shakti, a tutelary deity held in reverence for centuries by the Maharaja of Mysuru.

Chamundeshwari is called by the people of Karnataka as Nada Devi (ನಾಡ ದೇವಿ), which means state Goddess. It is situated at the elevation of around 3300 ft from the mean sea level. It is believed that Goddess Durga slayed the demon king Mahishasura on the top of this hill which was ruled by him. The place was later known as Mahishooru (Place of Mahisha). The British changed it to Mysore and later Kannadized into Mysuru.";
        } elseif ($id == 7) {
            echo "Hoysaleshwara temple, also referred simply as the Halebidu temple, is a 12th-century Hindu temple dedicated to the god Shiva. It is the largest monument in Halebidu, a town in the state of Karnataka, India and the former capital of the Hoysala Empire. The temple was built on the banks of a large man-made lake, and sponsored by King Vishnuvardhana of the Hoysala Empire.[2] Its construction started around 1121 CE and was complete in 1160 CE
            The Hoysaleswara temple is a Shaiva monument, yet reverentially includes many themes from Vaishnavism and Shaktism tradition of Hinduism, as well as images from Jainism.[10]
<br><br><br>
The Hoysaleswara temple is a twin-temple dedicated to Hoysaleswara and Santaleswara Shiva lingas, named after the masculine and feminine aspects, both equal and joined at their transept. It has two Nandi shrines outside, where each seated Nandi face the respective Shiva linga inside.[11] The temple includes a smaller sanctum for the Hindu Sun god Surya. It once had superstructure towers, but no longer and the temple looks flat.[12] The temple faces east, though the monument is presently visited from the north side. Both the main temples and the Nandi shrines are based on a square plan.[13] The temple was carved from soapstone.

It is notable for its sculptures, intricate reliefs, detailed friezes as well its history, iconography, inscriptions in North Indian and South Indian scripts. The temple artwork provides a pictorial window into the life and culture in the 12th century South India. About 340 large reliefs depict the Hindu theology and associated legends.[10] Numerous smaller friezes narrate Hindu texts such as the Ramayana, the Mahabharata and the Bhagavata Purana. Some friezes below large reliefs portray its narrative episodes";
        } elseif ($id == 8 ) {
            echo "Tourism is travel for pleasure, and the commercial activity of providing and supporting such travel. UN Tourism defines tourism more generally, in terms which go beyond the common perception of tourism as being limited to holiday activity only, as people travelling to and staying in places outside their usual environment for not more than one consecutive year for leisure and not less than 24 hours, business and other purposes. Tourism can be domestic (within the traveller's own country) or international. International tourism has both incoming and outgoing implications on a country's balance of payments.

Between the second half of 2008 and the end of 2009, tourism numbers declined due to a severe economic slowdown (see Great Recession) and the outbreak of the 2009 H1N1 influenza virus. These numbers, however, recovered until the COVID-19 pandemic put an abrupt end to the growth. The United Nations World Tourism Organization has estimated that global international tourist arrivals might have decreased by 58% to 78% in 2020, leading to a potential loss of US$0.1.2 trillion in international tourism receipts.";
        } elseif ($id == 9) {
            echo "Shanti Sagara tank, created by an embankment with sluice outlets, built in 1128, the tank has a history of 800 years. It took three years to construct the massive tank. The tank, which has a water spread of 6,550 acres (2,651 ha), has a circumference of 30 km (19 mi). It has a total drainage basin of 81,483 acres (32,975 ha). It irrigates 4,700 acres (1,900 ha) of land and more than 1000 villages are benefited by it.[2]

The tank receives the drainage of twenty square miles. All of the drainage pours into the gorge where it is built (the main stream bearing the name of Haridra, a tributary of the Tungabhadra). The embankment is constructed between two hills, and embankment is of no great length; it is around 950 ft (290 m), but it is of stupendous width (Max 120 ft (37 m), min 70 ft (21 m)), height and strength, though not quite straight. The main road connecting between Channagiri and Davanagere pass through on this embankment.[citation needed] It has resisted successfully the floods of centuries, but owing to the great pressure of the volume of the water in tank.[3]

It has two sluices. That to the north is called the Sidda, and that to the south the Basava. Notwithstanding the damaged state of the sluices and the great force of the water when escaping through them, the embankment has always remained firm and uninjured, a satisfactory proof of the solidity of the structure.[4]

If required (as during drought) the tank can be fed by surplus water from Bhadra Dam's right bank canal";
        } 
        else {
            echo htmlspecialchars($post['content']);
        }
        echo '</p>';

    } else {
        echo "Post not found.";
    }

} else {
    echo "No post ID provided.";
}
?>
