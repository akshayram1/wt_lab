package com.student.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

import com.student.dao.StudentRepository;
import com.student.entities.Student;
import com.student.services.StudentService;

@RestController
@CrossOrigin(origins = "http://localhost:3000", allowedHeaders = "*", exposedHeaders = "X-Get-Header")
@RequestMapping("/api/student")
public class StudentController {
	
	@Autowired
	private StudentService studentSerivce;
	
	@Autowired
	private StudentRepository studentRepository;
	
	@PostMapping("/save-data")
	public ResponseEntity<Student> addStudent(@RequestBody Student student)
	{
		Student savedStudent = studentSerivce.addStudent(student);
		return new ResponseEntity<>(savedStudent , HttpStatus.CREATED);
	}
	
	@GetMapping("/get-data")
	@ResponseBody
	public ResponseEntity<List<Student>> getStudents()
	{
		List<Student> students = studentRepository.findAll();
		
		return ResponseEntity.ok(students);
	}
	
	@PostMapping("/update-data")
	public ResponseEntity<Student> updateStudent(@RequestBody Student student)
	{
		Student updatedStudent =studentSerivce.updateStudent(student);
		return new ResponseEntity<>(updatedStudent ,HttpStatus.OK);
	}
	
	@GetMapping("/delete-data/{id}")
	public ResponseEntity<Student> deleteStudent(@PathVariable int id)
	{
		studentSerivce.deleteStudent(id);
		return new ResponseEntity<>(HttpStatus.OK);
	}
	


}
