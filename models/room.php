<?php
class Room {
  const IT = 1;
  const Reception = 2;
  const Bathroom = 3;
  const BreakRoom = 4;
  const CustomerSupport = 5;
  const HR = 6;
  const BossOffice = 7;
  const Lobby = 8;
  const CopyRoom = 9;
  const BoardRoom = 10;

  public static function printRooms() {
    echo "Room representation: </br>";
    echo "IT: " . self::IT . "</br>";
    echo "Reception: " . self::Reception . "</br>";
    echo "Bathroom: " . self::Bathroom . "</br>";
    echo "BreakRoom: " . self::BreakRoom . "</br>";
    echo "CustomerSupport: " . self::CustomerSupport . "</br>";
    echo "HR: " . self::HR . "</br>";
    echo "BossOffice: " . self::BossOffice . "</br>";
    echo "Lobby: " . self::Lobby . "</br>";
    echo "CopyRoom: " . self::CopyRoom . "</br>";
    echo "BoardRoom: " . self::BoardRoom . "</br>";
  }
}
?>
