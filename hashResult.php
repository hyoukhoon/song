<?php
$data="G101180053201807031830002515737";//gameId,gameRound,iday,islip,member_num,pick_num
//ab354817a5665e892a6769668abd67c3af2751361fbb07505796d93fdf67e2d6bee6dddf0880c66d0bb744cd27f834b0c2b09e86f95a2b6d4d86e7a538d37f4e

$hash_data = hash('sha512', $data);

echo "hash:".$hash_data;



?>
