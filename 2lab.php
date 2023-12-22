<?php

class User
{
    public $username;
    public $password;
    public $birthday;

    public function __construct($username, $password, $birthday)
    {
        $this->username = $username;
        $this->password = $password;
        $this->birthday = $birthday;
    }
}

class UserService
{
    public function sortByUsername($users, $direction = 'asc')
    {
        usort($users, function ($a, $b) use ($direction) {
            if ($direction == 'asc') {
                return strcmp($a->username, $b->username);
            } else {
                return strcmp($b->username, $a->username);
            }
        });

        return $users;
    }

    public function sortByBirthday($users, $direction = 'asc')
    {
        usort($users, function ($a, $b) use ($direction) {
            if ($direction == 'asc') {
                return $a->birthday <=> $b->birthday;
            } else {
                return $b->birthday <=> $a->birthday;
            }
        });

        return $users;
    }
}

$users = [
    new User('user3', 'password3', new DateTime('1990-05-25')),
    new User('user1', 'password1', new DateTime('1985-02-12')),
    new User('user2', 'password2', new DateTime('1995-09-08')),
];

$userService = new UserService();

// Сортировка по username в порядке возрастания
$sortedByUsernameAsc = $userService->sortByUsername($users);
echo "Sorted by username (ascending):\n";
foreach ($sortedByUsernameAsc as $user) {
    echo $user->username . "\n";
}

echo "\n";

// Сортировка по username в порядке убывания
$sortedByUsernameDesc = $userService->sortByUsername($users, 'desc');
echo "Sorted by username (descending):\n";
foreach ($sortedByUsernameDesc as $user) {
    echo $user->username . "\n";
}

echo "\n";

// Сортировка по birthday в порядке возрастания
$sortedByBirthdayAsc = $userService->sortByBirthday($users);
echo "Sorted by birthday (ascending):\n";
foreach ($sortedByBirthdayAsc as $user) {
    echo $user->username . " - " . $user->birthday->format('Y-m-d') . "\n";
}

echo "\n";

// Сортировка по birthday в порядке убывания
$sortedByBirthdayDesc = $userService->sortByBirthday($users, 'desc');
echo "Sorted by birthday (descending):\n";
foreach ($sortedByBirthdayDesc as $user) {
    echo $user->username . " - " . $user->birthday->format('Y-m-d') . "\n";
}
sleep(30);