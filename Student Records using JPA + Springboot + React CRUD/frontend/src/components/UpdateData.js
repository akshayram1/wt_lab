import React, { useState } from 'react';

const UpdateData = () => {
  // State to store form data
  const [formData, setFormData] = useState({
    id:'',
    name: '',
    city: '',
    age: '',
  });

  // Function to handle form input changes
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  // Function to handle form submission
  const handleFormSubmit = async (e) => {
    e.preventDefault();

    try {
      // Send a POST request to the API endpoint
     await fetch('http://localhost:8082/api/student/update-data', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      }).then(res => res.json()).then(result => console.log(result));

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
        <input type="number" name="id" value={formData.id} onChange={handleInputChange} />
      </label>
      <br />
      <label>
        Name:
        <input type="text" name="name" value={formData.name} onChange={handleInputChange} />
      </label>
      <br />
      <label>
        City:
        <input type="text" name="city" value={formData.city} onChange={handleInputChange} />
      </label>
      <br />
      <label>
        Age:
        <input type="text" name="age" value={formData.age} onChange={handleInputChange} />
      </label>
      <br />
      <button type="submit">Save</button>
    </form>
  );
};

export default UpdateData;
