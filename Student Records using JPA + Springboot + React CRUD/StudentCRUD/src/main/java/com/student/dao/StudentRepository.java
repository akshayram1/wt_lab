package com.student.dao;

import org.springframework.data.jpa.repository.JpaRepository;

import com.student.entities.Student;

public interface StudentRepository extends JpaRepository<Student, Long> {
	
	
}
