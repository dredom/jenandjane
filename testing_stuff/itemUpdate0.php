 
  <p>Update item: 
  <form action="itemUpdate1.php" >

  Item code: 
   <input type="text" name="item" size="15" value="<?php echo $_GET['item']; ?>"/>
   <input type="submit" value="Get Item"/>

  </form>  
  </p>
  
  
  <form action="itemShowAll.php">
   <input type="submit" name="all" value="Show all items"/>
  </form>
  
  
  <p><i>Add new item:</i> 
  <form action="itemAdd1.php" >
  Item code: <input type="text" name="item" size="15" />
  Price: <input type="text" name="price" size="10" />
  Description: 
  <textarea name="text" rows="3" cols="50" wrap="on" >
  </textarea>
  <input type="submit" value="Add Item"/>
  </p>
