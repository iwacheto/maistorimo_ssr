export const analitycMixin={
    data() {
        return {
          format: "d MMMM yyyy",
          startDate:'',
          endDate:'',
          formattedStartDate: '',
          formattedEndDate: '',
        };
      },
    methods:{
        formatPicker: function(){
            var self = this;
            var d = new Date(self.startDate);
            self.formattedStartDate =d.getUTCFullYear()  +"/"+ (d.getUTCMonth()+1) +"/"+d.getUTCDate() ;
        },
        formatEndPicker: function(){
            var self = this;
            var d = new Date(self.endDate);
            self.formattedEndDate =d.getUTCFullYear()  +"/"+ (d.getUTCMonth()+1) +"/"+d.getUTCDate() ;
        },
        calcStuff(stuff, value) {
            let temp = 0;
            stuff.forEach(item => {
              temp += item[value];
            });
            return temp;
          },
    }
}