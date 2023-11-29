import React, { useState } from 'react';

const DeleteData = () => {
  // State to store form data
  const [id, setId] = useState();

  

  // Function to handle form submission
  const handleFormSubmit = async (e) => {
    e.preventDefault();

    try {
      // Send a POST request to the API endpoint
     await fetch(`http://localhost:8082/api/student/delete-data/${id}`).then(result => console.log(result));

    //   if (response.ok) {
    //     console.log('Data saved successfully!');
    //     // You can add additional logic here, such as resetting the form
    //     // setFormData({ name: '', city: '', age: '' });
    //   } else {
    //     console.error('Failed to save data.');
    //   }
    } catch (error) {
      console.error('Error occurred while saving data:', error);
    }
  };

  return (
    <form onSubmit={handleFormSubmit}>
         <label>
        ID:
        <input type="number" name="id" value={id} onChange={(e) => setId(e.target.value)} />

      </label>
      <br/>
      <button type="submit">Save</button>
    </form>
  );
};

export default DeleteData;
