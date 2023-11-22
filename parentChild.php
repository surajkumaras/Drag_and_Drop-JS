<?php 
    include_once 'css.php';

?><html>
<head>
    <meta charset="UTF-8">
    <title>Drag and Drop Example</title>
    
</head>
<body>
    <div class="container">
        <form>
            <input type="text" id="InputAdd">
            <button id="ButtonAdd">Add Item</button>
        </form>
        <div id="box" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    </div>
</body>
</html>

<script>

document.getElementById("ButtonAdd").addEventListener('click', function(e) 
{
    e.preventDefault();
    let value1 = document.getElementById("InputAdd").value;  // <---- GET INPUT VALUE ----<<

    if(value1 === '')                                       // <----- CHECK INPUT VALUE ----<<
    {
        
    } 
    else 
    {
        let oldDiv = document.getElementById("box");
        let newDiv = createDiv(value1);
        oldDiv.appendChild(newDiv);                        // <------ APPEND AT THE END ---<<
    }
});

function createDiv(value) 
{
    let newDiv = document.createElement("div");
    newDiv.innerHTML = value;
    newDiv.className = "item";
    newDiv.draggable = "true";                           // <-------- ENABLE DRAG EVENT ---<<
    newDiv.id = "item_" + Date.now();
    
    newDiv.ondragstart = drag;

    let newInput = document.createElement("input");       //    <------------ FOR NEW INPUT FIELD ---<<
    newInput.type = "text";
    newInput.className = "childInput";

    let newButton = document.createElement("button");     //   <------------ FOR NEW BUTTON -------<<
    newButton.textContent = "Add child";
    newButton.addEventListener('click', function() 
    {
        let value2 = newInput.value;
        if(value2 ==='')                                // <----------- CHECK INPUT FIELD ------<<
        {
            
        } 
        else 
        {
            let childDiv = createDiv(value2);          // <-------- NEW CHILD CREATION ------<<
            childDiv.className = "subitem";
            childDiv.draggable = "true"; 
            childDiv.style.backgroundColor = getRandomColor(); // <---- FOR DYNAMIC BACKGROUND_COLOR --<<
            newDiv.appendChild(childDiv);
        }
    });

    newDiv.appendChild(newInput);
    newDiv.appendChild(newButton);

    return newDiv;                                // <--------- RETURN NEW CREATED DIV ----<<
}

function getRandomColor()                       // <---- DYNAMIC COLOR CREATION FUNCTION ----<< 
{
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) 
    {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function allowDrop(ev) 
{
    ev.preventDefault();                      // <----- PREVENT THE DEFAULT BEHAVIOR OF BROWSER ----<<
}

function drag(ev) 
{
    ev.dataTransfer.setData("text", ev.target.id); 
}

function drop(ev) 
{
    ev.preventDefault();
    let data = ev.dataTransfer.getData("text");
    let originalElement = document.getElementById(data);
    ev.target.appendChild(originalElement); 

    //originalElement.className = "subitem"; 
    //originalElement.style.backgroundColor = getRandomColor();
}
</script>
