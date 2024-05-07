use PHPUnit\Framework\TestCase;
use App\Models\CartModel;

class CartModelTest extends TestCase
{
    public function testCheckArray()
    {
        $cartModel = new CartModel();
        $array = $cartModel->getArray(); // Assuming you have a method named getArray() in your CartModel class

        $this->assertIsArray($array);
        $this->assertNotEmpty($array);
        // Add more assertions as per your requirements
    }
}