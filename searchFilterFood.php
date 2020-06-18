<?php

include_once("config.php");




if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['search'])) {
        if (!$_GET['search'] == "") {
            $key = $_GET['search'];
            $pattern = "/$key/i";
            // echo $key;

            $found_food = [];
            $found_res = [];

            $sql8 = "SELECT restaurant.Restaurant_ID,restaurant.Restaurant_Name,food.Food_Name FROM food INNER JOIN restaurant ON restaurant.Restaurant_ID = food.Restaurant_ID ORDER BY food.Food_Name";
            $result8 = $connectionString->query($sql8);
            while ($row = $result8->fetch_array()) {
                $res_id = $row['Restaurant_ID'];
                $res_name = $row['Restaurant_Name'];
                $food_name = $row['Food_Name'];

                if (preg_match($pattern, $food_name) > 0) {
                    $inside_found_pairs = [];
                    $inside_found_pairs[] = $food_name;
                    $inside_found_pairs[] = $res_id;
                    $inside_found_pairs[] = $res_name;
                    $found_food[] = $inside_found_pairs;
?>
                    <script>
                        document.querySelector("#foundMessage").innerHTML += "<?php echo "<tr><td>" . $food_name . "</td><td id='res_link'> <a title='Bring me to $res_name' href=menu.php?Restaurant_ID=" . $res_id . ">" . $res_name . "</a></td></tr>" ?>";
                        onFoundMessage();
                    </script>

                <?php
                }
            }
            if (count($found_food) < 1) {
                ?>
                <script>
                    onNotFoundMessage();
                </script>

            <?php
            }
            // echo "found food" . print_r($found_food);



            // $sql9 = "SELECT * FROM restaurant";
            // $result9 = $connectionString->query($sql9);
            // while ($res = $result9->fetch_array()) {
            //     $res_id = $res['Restaurant_ID'];
            //     $res_name = $res['Restaurant_Name'];

            //     if (preg_match($pattern, $res_name) > 0) {
            //         $inside_found_pairs = [];
            //         $inside_found_pairs[] = $res_id;
            //         $inside_found_pairs[] = $res_name;
            //         $found_res[] = $inside_found_pairs;
            //     }
            // }
            ?>
            <!-- <script>
            document.querySelector("#foundMessage").innerHTML += "<?php echo "</td><td id='res_link'> <a title='Bring me to $res_name' href=menu.php?Restaurant_ID=" . $res_id . ">" . $res_name . "</a></td></tr>" ?>";
            onFoundMessage();
        </script> -->

        <?php

        }
        // echo "found res" . print_r($found_res);
        else {
        ?>
            <script>
                onSearchEmptyMessage();
            </script>

<?php
            // echo "You didn't enter any key.";
        }
    }
}

$connectionString->close();
?>