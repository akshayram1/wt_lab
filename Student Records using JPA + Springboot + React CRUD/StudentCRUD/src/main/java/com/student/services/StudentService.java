package com.student.services;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.student.dao.StudentRepository;
import com.student.entities.Student;

@Service
public class StudentService {
	
	@Autowired
	private StudentRepository studentRepository;
	
	public Student addStudent(Student student)
	{
		return studentRepository.save(student);
	}
	
	public Student updateStudent(Student student)
	{
		 Optional<Student> optional = studentRepository.findById(student.getId());
		 Student st = optional.get();
		 st.setName(student.getName());
		 st.setCity(student.getCity());
		 st.setAge(student.getAge());
		 
		 return studentRepository.save(st);
	}
	public void deleteStudent(int id)
	{
		studentRepository.deleteById((long) id);
	}
}
