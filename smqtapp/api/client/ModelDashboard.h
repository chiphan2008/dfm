/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

/*
 * ModelDashboard.h
 * 
 * 
 */

#ifndef ModelDashboard_H_
#define ModelDashboard_H_

#include <QJsonObject>


#include "ModelCompany.h"
#include "ModelVehicle.h"
#include <QList>

#include "SWGObject.h"

namespace api {

class ModelDashboard: public SWGObject {
public:
    ModelDashboard();
    ModelDashboard(QString* json);
    virtual ~ModelDashboard();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelDashboard* fromJson(QString &jsonString);

    ModelCompany* getCompany();
    void setCompany(ModelCompany* company);

    QList<ModelVehicle*>* getVehicles();
    void setVehicles(QList<ModelVehicle*>* vehicles);


private:
    ModelCompany* company;
    QList<ModelVehicle*>* vehicles;
};

}

#endif /* ModelDashboard_H_ */
