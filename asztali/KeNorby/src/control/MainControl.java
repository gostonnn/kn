package control;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import view.AdminLogin;
import view.Main;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;
import net.proteanit.sql.DbUtils;

public class MainControl implements ActionListener {
    Connection conn = null;
    Statement stmt =null;
    ResultSet rs = null;
    private AdminLogin ALoginfrm;
    private  Main Mainfrm;
    
    
    public MainControl() {
        conn =ConnectDatabase.connection();
        setDefaultMode();
        ComponentsBoundActionListener();
    }
    private void ComponentsBoundActionListener() {

        ALoginfrm.getLoginBtn().addActionListener( this );
        
        Mainfrm.getSearch().addActionListener( this ); 
        Mainfrm.getBlock().addActionListener( this );
        Mainfrm.getAllow().addActionListener( this );
       
    }
    private void setDefaultMode() {
        
       ALoginfrm = new AdminLogin();
       ALoginfrm.setVisible( true );
       Mainfrm = new Main();
       Mainfrm.setVisible(false);
    }
    private void start(){
        Mainfrm.setVisible(true);
        ALoginfrm.dispose();
        ShowTable();
    }
    public void Login (){
        try {
            stmt =conn.createStatement();
            String User = ALoginfrm.getUserNameTf().getText();
            String Pass = ALoginfrm.getPassNameTf().getText();
            
            String sql =" SELECT * From kenorby WHERE UserName='"+User+"' && Password ='"+ Pass+"' ";
            
            rs =stmt.executeQuery(sql);
            if(rs.next()){
                start();
            }else{
            ALoginfrm.setStatusLbl("Hibás Adatok");
            }
        } catch (Exception e){JOptionPane.showMessageDialog(null, e);
        }
    }
    public void ShowTable(){      
        try{
            stmt =conn.createStatement();
            String sql = "SELECT `Email`, `UserName`, `Date`,`Text` FROM `authentication` INNER JOIN allow ON authentication.Allow = allow.Allow;";
            ResultSet res =stmt.executeQuery(sql);
            Mainfrm.getTbl().setModel(DbUtils.resultSetToTableModel(res));
        }catch (Exception e){JOptionPane.showMessageDialog(null, e);}
    }
    public void BlockUser (){
         try {
            int row = Mainfrm.getTbl().getSelectedRow();
            String User =Mainfrm.getTbl().getValueAt( row, 1 ).toString();
            stmt =conn.createStatement();
            boolean succes = false;

            String sql ="UPDATE `authentication` SET `Allow`=1 WHERE UserName='"+User+"' ";
            rs =stmt.executeQuery(sql);
            succes=true;

            if(succes){
                String UserName = Mainfrm.getSUser().getText();
                if(UserName.length() <1){
                    ShowTable();
                }else{
                    SearchUser();
                }
            }
        } catch (Exception e){JOptionPane.showMessageDialog(null, e);
        }
    }
    public void AllowUser (){
        try {
            int row = Mainfrm.getTbl().getSelectedRow();
            String User =Mainfrm.getTbl().getValueAt( row, 1 ).toString();
            stmt =conn.createStatement();
            boolean succes = false;

            String sql ="UPDATE `authentication` SET `Allow`=0 WHERE UserName='"+User+"' ";
            rs =stmt.executeQuery(sql);
            succes=true;

            if(succes){
                //DefaultTableModel model = (DefaultTableModel)Mainfrm.getTbl().getModel();
                //model.setRowCount(0);
                String UserName = Mainfrm.getSUser().getText();
                if(UserName.length() <1){
                    ShowTable();
                }else{
                    SearchUser();
                }
            }
        } catch (Exception e){JOptionPane.showMessageDialog(null, e);
        }
    }
    public void SearchUser (){
        String User = Mainfrm.getSUser().getText();
        if(User.length() <1){
            ShowTable();
        }else{
            try{
            stmt =conn.createStatement();
            String sql = "SELECT `Email`, `UserName`, `Date`,`Text` FROM `authentication` INNER JOIN allow ON authentication.Allow = allow.Allow WHERE UserName = '"+User+"';";
            ResultSet res =stmt.executeQuery(sql);
            Mainfrm.getTbl().setModel(DbUtils.resultSetToTableModel(res));
            }catch (Exception e){JOptionPane.showMessageDialog(null, e);}
        }
    }
    @Override
    public void actionPerformed( ActionEvent event ) {
            if( event.getSource() == ALoginfrm.getLoginBtn()) {
                Login();       
            }else if (event.getSource() == Mainfrm.getSearch()){ 
                SearchUser();
            }else if (event.getSource() == Mainfrm.getBlock()){
                BlockUser();
            }else if (event.getSource() == Mainfrm.getAllow()){  
                AllowUser();
            }
    }
}
 

   
    

