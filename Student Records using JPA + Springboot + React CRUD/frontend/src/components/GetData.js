import React from "react" 
import { useEffect, useState } from "react"

export default function GetData() {
    const [ result, setResult ] = useState()


    useEffect(() => {
      fetch("http://localhost:8082/api/student/get-data")
        .then((res) => res.json())
        .then(result=>setResult(result))
        .catch(err=>console.log(err));
    }, [result])
    
    return (
        <div>
            {result?.map((r) => (
                <div key={r.id}>
                    <p>{r.name}</p>
                    <p>{r.age}</p>
                    <p>{r.city}</p>
                </div>
            ))
            }
        </div>
    )
}