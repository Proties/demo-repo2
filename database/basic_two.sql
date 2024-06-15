-- sql views 

-- a view that will store the 2 post of a user with preview status true
-- the user must have atleast two post in order to be isted on the view that


-- a view that will store categories of 

CREATE TABLE Forms(
    formID int,
    formName,
    formDescription,
    formFileName,
    formPath,
    formStatus,
    dateMade,
    dateModified,
    
);
CREATE TABLE FormInput(
    formField,
    dataType,
    description,
    value,
    hidden
);
CREATE TABLE FormImages(
    imageID int,
    formID int,
    foreign key (formID) references(formID)Forms,
    foreign key (imageID) references(imageID)Images

);