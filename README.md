# remotecodes
Automated remote code generator for the Sky interactive TV remote code application

Remote Control Code File Processor
This application processes the remote control code information file provided to BSkyB by UEBV or UEI and produces the files required by the remote control interactive application.


The input file must be a comma delimited value file with a .CSV extension in the following format:


<Manufacturer>,<TV Model>,<Remote Code>,
<Manufacturer>,<TV Model>,<Remote Code>,
...


The resulting files are the following:

Manu_list.txt	Alphabetical list of manufacturers
manufacturers.txt	Index file. Pointer positions for interactive app.
Codes_a_to_c.txt	Codes for models made by manufacturers names A through to C
Codes_d_to_f.txt	Codes for models made by manufacturers names D through to F
Codes_g.txt	Codes for models made by manufacturers names starting with G
Codes_h_to_k.txt	Codes for models made by manufacturers names H through to K
Codes_l_to_m.txt	Codes for models made by manufacturers names L through to M
Codes_n_to_o.txt	Codes for models made by manufacturers names N through to O
Codes_p.txt	Codes for models made by manufacturers names starting with P
Codes_q_to_s.txt	Codes for models made by manufacturers names Q through to S
Codes_t_to_z.txt	Codes for models made by manufacturers names T through to Z
Models_a_to_c.txt	Models made by manufacturers names A through to C
Models_d_to_f.txt	Models made by manufacturers names D through to F
Models_g.txt	Models made by manufacturers names starting with G
Models_h_to_k.txt	Models made by manufacturers names H through to K
Models_l_to_m.txt	Models made by manufacturers names L through to M
Models_n_to_o.txt	Models made by manufacturers names N through to O
Models_p.txt	Models made by manufacturers names starting with P
Models_q_to_s.txt	Models made by manufacturers names Q through to S
Models_t_to_z.txt	Models made by manufacturers names T through to Z
