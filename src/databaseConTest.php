
<?php

use PHPUnit\Framework\TestCase;
include 'db_connect.php';

class DatabaseConTest extends TestCase
{
    public function testCheckDatabaseConnection():void
    {

        try{
        set_time_limit(60);
        // Arrange: Create an instance of DatabaseConnection
        $db = new DatabaseConnection();

        // Act: Get the connection
        $conn = $db->getConnection();

        $this->assertNotNull($conn, 'Database connection object is null');
        // Assert: Check if the connection is an instance of MySQLi
        $this->assertInstanceOf(mysqli::class, $conn);

        // Assert: Check if the connection is successful
        $this->assertFalse($conn->connect_error, 'Database connection failed');
        }
        catch (mysqli_sql_exception $e) {
            echo "Exception: " . $e->getMessage();
            // Optionally, log the full exception stack trace
            echo $e->getTraceAsString();
        }
    }
} 







